<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recusive;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Product_discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DiscountController extends Controller
{
    private $discount;
    private $product;
    private $category;
    private $product_discount;

    public function __construct(Discount $discount, Product $product, Category $category, Product_discount $product_discount)
    {
        $this->discount         = $discount;
        $this->product          = $product;
        $this->category         = $category;
        $this->product_discount = $product_discount;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = $this->discount->all();
        return view('admin.manage_discount.index', compact('discounts'));
    }
    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        $products   = $this->product->where('status', '=', 'Available')->get();
        return view('admin.manage_discount.create', compact('htmlOption', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $err                =   [];
            $name               =   $request->name;
            $description        =   $request->description;
            $discount_type      =   $request->discount_type;
            $discount_price     =   $request->discount_price;
            $discount_percent   =   $request->discount_percent;
            $date_start         =   date('Y-m-d H:i', strtotime($request->date_start));
            $date_end           =   date('Y-m-d H:i', strtotime($request->date_end));
            $apply_for          =   $request->apply_for;
            $product_id         =   $request->product_id;
            $category_id        =   $request->category_id;
            $getName            =   $this->discount->where('name', $name)->exists();
            $dateNow            =   date("Y-m-d H:i:s");
            if(trim($name) == null) {
                $err['name'] = 'Name of discount must be required!';
            }
            if($discount_type == null){
                $err['discount_type'] = 'Type of discount must be required!';
            } else {
                if($discount_type == 'Price' && $discount_price == null){
                    $err['discount_price'] = 'Price of discount must be required!';
                } elseif($discount_type == 'Percent' && $discount_percent == null){
                    $err['discount_percent'] = 'Percent of discount must be required!';
                } elseif($discount_type == 'Percent' && $discount_percent > 100){
                    $err['percent_illegal'] = 'The percentage must be between 0% and 100%!';
                }
            }
            
            if($apply_for == 'Product'){
                if($product_id == null){
                    $err['product_id'] = 'The product must be required!';
                } 
            } elseif($apply_for == 'Category'){
                if($category_id == null){
                    $err['category_id'] = 'The category must be required!';
                }
            }
        
            if($request->date_start == null){
                $err['date_start'] = 'The start date must be required!';
            } 
            if($request->date_end == null){
                $err['date_end'] =  'The end date must be required!';
            } elseif($request->date_end != null && $request->date_start != null){
                if($date_end < $dateNow){
                    $err['date_end_lower_date_now'] =  'The end date must be greater than current date!';
                } 
                if($date_end < $date_start){
                    $err['date_end_lower_date_start'] =  'The end date must be greater than start date!';
                } 
            }
            if($getName == true){
                $err['duplicate_name'] = 'Discount is already exists!';
            }

            if(count($err) > 0){
                return redirect()->back()->withInput()->with($err);
            } else {
                DB::beginTransaction();
                $data = [
                    'name'          =>  $name,
                    'description'   =>  $description,
                    'apply_for'     =>  $apply_for,
                    'discount_type' =>  $discount_type,
                    'date_start'    =>  $date_start,
                    'date_end'      =>  $date_end
                ];

                // Logic để check xem sản phẩm có tồn tại discount?
                if($product_id){
                    foreach ($product_id as $item) {
                        $get_discount_by_id_product = $this->product_discount->where('product_id', $item)->get();
                        // Nếu đã tồn tại thì check xem thời gian discount còn không (lấy date_end so sánh với date_current?
                        // - false: thì cho phép thêm discount
                        // - true thì quay lại form thêm discount + báo lỗi
                        if($get_discount_by_id_product){
                            foreach($get_discount_by_id_product as $value){
                                if($value->date_end > $value->date_now){
                                    $err_product['product_has_discount'] = "ERROR! The product already has a discount or the discount period has not ended";
                                    return redirect()->back()->withInput()->with($err_product);
                                }
                            }
                        }
                    }
                }
                if($category_id){
                    // login check category_id tương tự
                    foreach ($category_id as $item) {
                        $get_discount_by_id_category = $this->product_discount->where('category_id', $category_id)->get();
                        if($get_discount_by_id_category){
                            foreach($get_discount_by_id_category as $value){
                                if($value->date_end > $value->date_now){
                                    $err_category['category_has_discount'] = "ERROR! The category already has a discount or the discount period has not ended";
                                    return redirect()->back()->withInput()->with($err_category);
                                }
                            }
                        }
                    }
                }
                // Logic để phân loại khuyến mãi là % hay $
                if($discount_type == 'Percent'){
                    $data['discount']   =   $discount_percent;
                } elseif($discount_type == 'Price') {
                    $data['discount']   =   $discount_price;
                }
                // Khi mọi điều kiện thoả mãn thì insert $data bào table discounts
                $discount = $this->discount->create($data);

                if($apply_for == 'Product'){
                    $price_unit = 0;
                    foreach($product_id as $id){
                        $getProduct = $this->product->where('id', $id)->get('price');
                        foreach($getProduct as $value){
                            if($discount_type == 'Price'){
                                $price_unit = $value->price - $discount_price;
                            } elseif($discount_type == 'Percent'){
                                $price_unit = ($value->price)*(100 - $discount_price)/100;
                            }
                        }
                        // dd($price_unit);
                        $discount->product_discount()->create([
                            'product_id'    =>  $id,
                            'price_unit'    =>  $price_unit,
                            'date_start'    =>  $date_start,
                            'date_end'      =>  $date_end,
                        ]);
                    }
                } 
                if($apply_for == 'Category'){
                    $price_unit = 0;
                    foreach($category_id as $id){
                        $products = $this->product->where('category_id', $id)->get();
                        foreach($products as $product){
                            $check_product_in_discount = $this->product_discount->where('product_id', '=', $product->id)->first();
                           
                            if($check_product_in_discount){
                                $err_product_in_category['product_in_category_has_discount'] = "ERROR! In the category containing the product the product is discounted";
                                return redirect()->back()->withInput()->with($err_product_in_category);
                            } else {
                                if($discount_type == 'Price'){
                                    $price_unit = $product->price - $discount_price;
                                } elseif($discount_type == 'Percent'){
                                    $price_unit = ($product->price)*(100 - $discount_price)/100;
                                }
                            }
                            $discount->product_discount()->create([
                                'product_id'    =>  $product->id,
                                'category_id'   =>  $id,
                                'price_unit'    =>  $price_unit,
                                'date_start'    =>  $date_start,
                                'date_end'      =>  $date_end,
                            ]);
                        }
                    }
                }
                DB::commit();
                if($discount){
                    $request->session()->put('success', '<span class="fw-bolder text-uppercase"">success!</span><span> Add New Discount Successful</span>');
                        return redirect()->route('discount.index');
                }
            }
        } catch (\Exception $exc) {
            DB::rollBack();
            Log::error("Message: " . $exc->getMessage() . ' Line: ' . $exc->getLine());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
