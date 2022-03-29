<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recusive;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product_Tag;
use App\Models\ProductImage;
use App\Models\Specification;
use App\Models\Specification_detail;
use App\Models\Specification_name;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use StorageImageTrait;
    private $product;
    private $category;
    private $productImage;
    private $tag;
    private $product_tag;
    private $specification_name;
    private $specification_detail;
    private $specification;
    public function __construct(Product $product, Category $category, ProductImage $productImage, Tag $tag, Product_Tag $product_tag, Specification $specification, Specification_name $specification_name, Specification_detail $specification_detail )
    {
        $this->product              = $product;
        $this->category             = $category;
        $this->productImage         = $productImage;
        $this->tag                  = $tag;
        $this->product_tag          = $product_tag;
        $this->specification_name   = $specification_name;
        $this->specification_detail = $specification_detail;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->product->all();
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.manage_product.index', compact('products', 'htmlOption'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.manage_product.create', compact('htmlOption'));
    }
    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecusive($parentId);
        return $htmlOption;
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
            $err = [];
            $name                   =   $request->name;
            $price                  =   $request->price;
            $status                 =   $request->status;
            $image_path             =   $request->image_path;
            $product_code           =   $request->product_code;
            $description            =   $request->desc;
            $category_id            =   $request->category_id;
            $slug                   =   strtolower(str_replace(' ','-', $name));
            $getName        =   $this->product->where('name', $request->name)->exists();
            if(trim($name) == null){
                $err['name'] = 'Name must be required!';
            }
            if(trim($price) == null){
                $err['price'] = 'Price must be required!';
            }
            if($status == ""){
                $err['status'] = 'Status must be required!';
            }
            if(trim($image_path) == null){
                $err['image'] = 'Image must be required!';
            }
            if(trim($product_code) == null){
                $err['code'] = 'Product code must be required!';
            }
            if(trim($description) == null){
                $err['desc'] = 'Description must be required!';
            }
            if(trim($category_id) == null){
                $err['category_id'] = 'Category must be required!';
            }
            if($getName == true){
                $err['duplicate_name'] = 'Product already exists!';
            }
            if(count($err) > 0){
                return redirect()->back()->withInput()->with($err);
            } else {
                DB::beginTransaction();
                $data = [
                    'name'          =>  $name,
                    'price'         =>  $price,
                    'status'        =>  $status,
                    'product_code'  =>  $product_code,
                    'desc'          =>  $description,
                    'category_id'   =>  $category_id,
                    'slug'          =>  $slug
                ];
                $dataUploadFeatureImage = $this->storageTraitUpload($request, 'image_path', 'product');
                if(!empty($dataUploadFeatureImage)){
                    $data['image_path'] = $dataUploadFeatureImage['file_path'];
                    $data['image_name'] = $dataUploadFeatureImage['file_name'];
                }
                $product = $this->product->create($data);

                // Insert data to product_images
                if($request->hasFile('thumbnails_path')){
                    foreach($request->thumbnails_path as $fileItem){
                        $dataImageThumbnail = $this->storageTraitUploadMultiple($fileItem, 'thumbnails_img');
                        $product->productImages()->create([
                            'thumbnails_path'   =>  $dataImageThumbnail['file_path'],
                            'thumbnails_name'   =>  $dataImageThumbnail['file_name']
                        ]);
                    }
                }
                
                // Insert tags for product
                if($request->tags){
                    foreach($request->tags as $tagItem){
                        // Insert to tags
                        $tags = $this->tag->firstOrCreate(['name'=> $tagItem]);
                        $tagId[] = $tags->id;
                    }
                    $product->tags()->attach($tagId);
                }
                
                // Insert Specification for product
                if($request->name_specification && $request->detail_specification){
                    // Create link Product table vs Specification table
                    $create_specification = $product->specification()->create();

                    // Insert names for Specification_names table
                    foreach ($request->name_specification as $value) {
                        $this->specification_name->create([
                            'specification_id'  =>  $create_specification->id,
                            'name'              =>  $value
                        ]);
                    }        
                    // Insert details for Specification_details table
                    foreach ($request->detail_specification as $value) {
                        $this->specification_detail->create([
                            'specification_id'  =>  $create_specification->id,
                            'detail'            =>  $value
                        ]);
                    }         
                }
                
                // dd(123);
                DB::commit();
                if($product){
                    $request->session()->put('success', '<span class="fw-bolder text-uppercase"">success!</span><span> Add New Product Successful</span>');
                    return redirect()->route('product.index');
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            $this->product->find($id)->delete();
            return response()->json([
                'code'      => 200,
                'message'   => 'success'
            ], 200);
        } catch (\Exception $exc) {
            Log::error("Message: " . $exc . " Line: " . $exc->getLine());
            return response()->json([
                'code'      => 500,
                'message'   => 'fail'
            ], 500);
        }
    }

    public function search(Request $request){
        $status     =   $request->get('status_filter');
        $sort       =   $request->get('sort_filter');
        $category   =   $request->get('category_filter');
        $htmlOption =   $this->getCategory($category);
        $products   =   [];
        if($category == null && $status == null){
            $products = $this->product->whereNull('deleted_at')->get();
            if($sort == 'asc' ){
                $products = $this->product->where('status', $status)->where('category_id','like','%'.$category.'%')->whereNull('deleted_at')->orderBy('price', 'asc')->get();
            }
            if($sort == 'desc' ){
                $products = $this->product->where('status', $status)->where('category_id','like','%'.$category.'%')->whereNull('deleted_at')->orderBy('price', 'desc')->get();
            }
    
            if($sort == 'latest' ){
                $products = $this->product->where('status', $status)->where('category_id','like','%'.$category.'%')->whereNull('deleted_at')->orderBy('created_at','asc')->get();
            }
            if($sort == 'oldest'){
                $products = $this->product->where('status', $status)->where('category_id','like','%'.$category.'%')->whereNull('deleted_at')->orderBy('created_at', 'desc')->get();
            }
        } else {
            
            if($status != null){
                $products = $this->product->where('status', $status)->whereNull('deleted_at')->get();
                if($sort == 'asc' ){
                    $products = $this->product->where('status', $status)->whereNull('deleted_at')->orderBy('price', 'asc')->get();
                }
                if($sort == 'desc' ){
                    $products = $this->product->where('status', $status)->whereNull('deleted_at')->orderBy('price', 'desc')->get();
                }
                if($sort == 'latest' ){
                    $products = $this->product->where('status', $status)->whereNull('deleted_at')->orderBy('created_at','desc')->get();
                }
                if($sort == 'oldest'){
                    $products = $this->product->where('status', $status)->whereNull('deleted_at')->orderBy('created_at', 'asc')->get();
                }
            }
            if($category != null){
                $products = $this->product->where('category_id','like','%'.$category.'%')->whereNull('deleted_at')->get();
                if($sort == 'asc' ){
                    $products = $this->product->where('category_id','like','%'.$category.'%')->whereNull('deleted_at')->orderBy('price', 'asc')->get();
                }
                if($sort == 'desc' ){
                    $products = $this->product->where('category_id','like','%'.$category.'%')->whereNull('deleted_at')->orderBy('price', 'desc')->get();
                }
        
                if($sort == 'latest' ){
                    $products = $this->product->where('category_id','like','%'.$category.'%')->whereNull('deleted_at')->orderBy('created_at','desc')->get();
                }
                if($sort == 'oldest'){
                    $products = $this->product->where('category_id','like','%'.$category.'%')->whereNull('deleted_at')->orderBy('created_at', 'asc')->get();
                }
            }
            if($status != null  && $category != null){
                $products = $this->product->where('status', $status)->where('category_id','like','%'.$category.'%')->whereNull('deleted_at')->get();
                if($sort == 'asc' ){
                    $products = $this->product->where('category_id','like','%'.$category.'%')->where('status', $status)->whereNull('deleted_at')->orderBy('price', 'asc')->get();
                }
                if($sort == 'desc' ){
                    $products = $this->product->where('category_id','like','%'.$category.'%')->where('status', $status)->whereNull('deleted_at')->orderBy('price', 'desc')->get();
                }
        
                if($sort == 'latest' ){
                    $products = $this->product->where('category_id','like','%'.$category.'%')->where('status', $status)->whereNull('deleted_at')->orderBy('created_at','desc')->get();
                }
                if($sort == 'oldest'){
                    $products = $this->product->where('category_id','like','%'.$category.'%')->where('status', $status)->whereNull('deleted_at')->orderBy('created_at', 'asc')->get();
                }
            }
        }        
        return view('admin.manage_product.index', compact('products', 'htmlOption', 'status', 'sort'));
    }
}
