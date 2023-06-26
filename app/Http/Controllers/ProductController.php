<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->file_stored = 'public/products/';
        $this->file_path = storage_path('app/public/products');
        $this->file_path_view = \Request::root().'/storage/products/';
    }
    


    public function index()
    {
        $products = Product::orderByDesc('id')->paginate(8);
        $categories = Category::all();

        return view('products.index')->with('products', $products)
                                    ->with('categories', $categories)
                                    ->with('file_path_view', $this->file_path_view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product;
        $categories = Category::all();
        $product_categories = $product->categories;
        return view('products.create')->with('product', $product)
                                   ->with('categories', $categories)
                                   ->with('product_categories', $product_categories)
                                   ->with('file_path_view', $this->file_path_view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $givenData = $request->only(['name', 'code', 'price', 'quantity', 'description', 'warranty']);
        $givenCategories = $request->categories;
        $product = Product::create($givenData);
        $product->categories()->sync($givenCategories);

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $filename = str_replace(" ","-",$product->name).'_'.time().'.'.$uploadedFile->extension();

            if (!is_dir($this->file_path)) {
                mkdir($this->file_path, 0777);
            }

            $uploadedFile->storeAs($this->file_stored, $filename);
            $url = '/storage/products/'.$filename;
            $imageUpload = new Image([
                'name' => $filename,
                'url' => $url,
                'type' => 1
            ]);
            $product->images()->save($imageUpload); 
        }

        return redirect()->route('products.index')->withSuccess('Product successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show')->with('product', $product)
                                 ->with('file_path_view', $this->file_path_view);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $product_categories = $product->categories;
        return view('products.edit')->with('product', $product)
                                ->with('categories', $categories)
                                ->with('product_categories', $product_categories)
                                ->with('file_path_view', $this->file_path_view);
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
        $givenData = $request->only(['name', 'code', 'price', 'quantity', 'description', 'warranty']);
        $givenCategories = $request->categories;
        $product->update($givenData);
        $product->categories()->sync($givenCategories);

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $filename = str_replace(" ","-",$product->name).'_'.time().'.'.$uploadedFile->extension();

            if (!is_dir($this->file_path)) {
                mkdir($this->file_path, 0777);
            }
            $uploadedFile->storeAs($this->file_stored, $filename);
            $url = '/storage/products/'.$filename;

            if($product->getImage() != ""){
                $product_image = $product->images[0] ;
                $product_image_name = $product->images[0]->name ;
                if(Storage::exists($this->file_stored.$product_image_name)){
                    Storage::delete($this->file_stored.$product_image_name) ;
                }
                $product_image->update([
                    'name' => $filename,
                    'url' => $url,
                ]);

                $product->images()->save($product_image);
            }else{
                $imageUpload = new Image([
                    'name' => $filename,
                    'url' => $url,
                    'type' => 1
                ]);
                $product->images()->save($imageUpload);
            }
        }
        return redirect()->route('products.index')->withSuccess('Product successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->getImage() != ""){
            $product_image = $product->images[0]->name ;
            if(Storage::exists($this->file_stored.$product_image)){
                Storage::delete($this->file_stored.$product_image) ;
            }
            $product->images[0]->delete();
        }
        $product->delete();
        return redirect()->route('products.index')->withFail('Product Deleted');
    }



    public function search(Request $request)
    {
        $categories = Category::all();

        $category = $request->category;
        $name = $request->name;
        $code = $request->code;

        if($category == null && $name == null && $code == null) {
            $products = Product::orderByDesc('id')->paginate(8);
            return view('products.index')->with('products', $products)
                                    ->with('categories', $categories)
                                    ->with('file_path_view', $this->file_path_view);
        }
        elseif ($category != null && $name == null && $code == null) {
            $products = Product::whereHas('categories', function($categoriesQuery) use ($category) {
                $categoriesQuery->where('category_id', '=', $category);
            })->orderByDesc('id')->paginate(8);
            return view('products.index')->with('products', $products)
                ->with('categories', $categories)
                ->with('file_path_view', $this->file_path_view);
        }
        elseif($category == null && $name != null && $code == null) {
            $products = Product::where('name', 'like', '%'.$name.'%')->orderByDesc('id')->paginate(8);
            return view('products.index')->with('products', $products)
                ->with('categories', $categories)
                ->with('file_path_view', $this->file_path_view);
        }
        elseif($category == null && $name == null && $code!=null) {
            $products = Product::where('code', 'like', '%'.$code.'%')->orderByDesc('id')->paginate(8);
            return view('products.index')->with('products', $products)
                ->with('categories', $categories)
                ->with('file_path_view', $this->file_path_view);
        }
        elseif ($category != null && $name != null && $code==null) {
            $products = Product::where('name', 'like', '%'.$name.'%')
            ->whereHas('categories', function($categoriesQuery) use ($category) {
                $categoriesQuery->where('category_id', '=', $category);
            })->orderByDesc('id')->paginate(8);
            return view('products.index')->with('products', $products)
                ->with('categories', $categories)
                ->with('file_path_view', $this->file_path_view);
        }
        elseif($category == null && $name != null && $code!=null) {
            $products = Product::where('name', 'like', '%'.$name.'%')
                        ->where('code', 'like', '%'.$code.'%')->orderByDesc('id')->paginate(8);
            return view('products.index')->with('products', $products)
                ->with('categories', $categories)
                ->with('file_path_view', $this->file_path_view);
        }
        elseif ($category != null && $name == null && $code != null) {
            $products = Product::where('code', 'like', '%'.$code.'%')
            ->whereHas('categories', function($categoriesQuery) use ($category) {
                $categoriesQuery->where('category_id', '=', $category);
            })->orderByDesc('id')->paginate(8);
            return view('products.index')->with('products', $products)
                ->with('categories', $categories)
                ->with('file_path_view', $this->file_path_view);
        }

        return redirect()->route('products.index');
    }

    public function attributesview(Product $product){
        $attributes = Attribute::all();
        return view('products.attributes')->with('attributes', $attributes)
                                         ->with('product', $product);
    }

    public function attributesstore(Request $request, Product $product){
        $data = array(
            "product_id" => $product->id,
            "attribute_id" => $request->attribute_id,
            "attribute_value" => $request->attribute_value
        );

        DB::table('products_attributes')->insert($data);
        return redirect()->back();
    }

    public function indexapi()
    { 
        $products = Product::with('categories')->with('attributes')->get();
        return $products;
    }

}
