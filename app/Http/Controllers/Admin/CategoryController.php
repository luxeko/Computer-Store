<?php

namespace App\Http\Controllers\Admin;

use App\Components\Recusive;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    private $category;
    private $product;
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product  = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $get_categories = $this->category->latest()->paginate(5);
        // return view('admin.manage_category.index', compact('get_categories', 'currentPage', 'perPage', 'total'));
        $categories = $this->category->all();
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.manage_category.index', compact('categories', 'htmlOption'));
    }
    public function getCategory($parentId){
        $data       = $this->category->all();
        $recusive   = new Recusive($data);
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
        // dd($htmlOption);
        return view('admin.manage_category.create', compact("htmlOption"));
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
            $getName        = $this->category->where('name', $request->name)->exists();
            $name           = $request->name;
            $description    = $request->description;
            $status         = $request->status;
            $slug           = strtolower(str_replace(' ','-',$request->category_name));
            $parent_id      = $request->parent_id;
            $err = [];
            if(trim($name) == null){
                $err['name'] = "Name must be required!";
            }
            if($status == ""){
                $err['status'] = "Status must be required!";
            }
            if($description == ""){
                $err['description'] = "Description must be required!";
            }
            if($getName == true){
                $err['duplicate_name'] = 'Data already exists!';
            }
            if(count($err) > 0){
                return redirect()->back()->withInput()->with($err);
            } else {
                DB::beginTransaction();
                $result = $this->category->create([
                    'name'          => $name,
                    'description'   => $description,
                    'slug'          => $slug,
                    'status'        => $status,
                    'parent_id'     => $parent_id
                ]);
                if($result){
                    $request->session()->put('success', 'Add New Category Successful');
                    DB::commit();
                    return redirect()->route('category.index');
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
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.manage_category.edit', compact("htmlOption", 'category'));
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
        try {
            $getName        = $this->category->where('name', $request->name)->exists();
            $getCurrentName = $this->category->where('id', $id)->get('name');
           
            $name           = $request->name;
            $description    = $request->description;
            $status         = $request->status;
            $slug           = strtolower(str_replace(' ','-',$request->category_name));
            $parent_id      = $request->parent_id;
            $err = [];
            // dd($getCurrentName);
            // dd($name);
            // if($name == $getCurrentName){
            //     dd(true);
            // } else {
            //     dd(false);
            // }
            
            if(trim($name) == null){
                $err['name'] = "Name must be required!";
            }
            if($status == ""){
                $err['status'] = "Status must be required!";
            }
            if($description == ""){
                $err['description'] = "Description must be required!";
            }
            foreach($getCurrentName as $value){
                // dd($value->name);
                if($getName == true &&  $name != $value->name){
                    $err['duplicate_name'] = 'Data already exists!';
                }
            }
            if(count($err) > 0){
                return redirect()->back()->withInput()->with($err);
            } else {
                DB::beginTransaction();
                $result = $this->category->find($id)->update([
                    'name'          => $name,
                    'description'   => $description,
                    'slug'          => $slug,
                    'status'        => $status,
                    'parent_id'     => $parent_id
                ]);
                if($result){
                    $request->session()->put('success', 'Update Category Successful');
                    DB::commit();
                    return redirect()->route('category.index');
                } 
            }
        }  catch (\Exception $exc) {
            DB::rollBack();
            Log::error("Message: " . $exc->getMessage() . ' Line: ' . $exc->getLine());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){
        try {
            $findProduct = $this->product->where('category_id', $id)->get();
            if($findProduct){
                return redirect()->back()->with('delete_error', 'Can\'t delete!!! There are products in this category');
            } else {
                $this->category->find($id)->delete();
                return response()->json([
                    'code'      => 200,
                    'message'   => 'success'
                ], 200);
            }
        } catch (\Exception $exc) {
            Log::error("Message: " . $exc . " Line: " . $exc->getLine());
            return response()->json([
                'code'      => 500,
                'message'   => 'fail'
            ], 500);
        }
        
    }
}
