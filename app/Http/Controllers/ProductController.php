<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LocaleContent;
use App\Models\Product;
use App\Models\PType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_ptypes = LocaleContent::where(['section' => 'ptype', 'locale' => 'fa', 'element_title' => 'ptype'])->pluck('element_content', 'element_id');
        $product_categories = LocaleContent::where(['section' => 'category', 'locale' => 'fa', 'element_title' => 'category'])->pluck('element_content', 'element_id');
        return view('PageElements.Dashboard.Setting.Products', compact('product_ptypes', 'product_categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Product = new Product;
        $Product->cat_id = $request->input('category');
        $Product->save();
        if ($request->hasFile('product_images')) {
            $images = [];
            foreach ($request->file('product_images') as $file) {
                $file->getClientOriginalName();
                $uploaded = $file;
                $filename = $file->getClientOriginalName();
                $uploaded->storeAs('public\Main\Products\ptype' . $request->input('ptype') . '\cat' . $request->input('category') . '\products\product' . $Product->id . '\p_images\\', $filename);
                $images[] = $filename;
            }
            $Product->images = serialize($images);
            $Product->update();
        }
        return redirect('/Product');
    }

    /**
     * Display the specified resource.
     *
     * @param $CatID
     * @return \Illuminate\Http\Response
     */
    public function show($CatID)
    {

        $result = Product::where('cat_id', $CatID)->get();
        $Products = [];
        foreach ($result as $key => $item) {
            $Products[$key]['id'] = $item['id'];
            $Products[$key]['ptype'] = Category::where('id', $CatID)->value('ptype_id');
            $Products[$key]['image'] = asset('storage/Main/Products/ptype' . $Products[$key]['ptype'] . '/cat' . $CatID . '/products/product' . $Products[$key]['id'] . '/p_images/' . app()->getLocale() . '.jpg');
        }
        return $Products;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product)
    {
        $Selectedproduct = Product::where('id', $product)->first();
        $product_ptypes = LocaleContent::where(['section' => 'ptype', 'locale' => 'fa', 'element_title' => 'ptype'])->pluck('element_content', 'element_id');
        $Selectedptype = Category::where('id', $Selectedproduct->cat_id)->value('ptype_id');
        $ptype_categories = Category::where('ptype_id', $Selectedptype)->with('contents', function ($query) {
            $query->where('locale', '=', 'fa')
                ->pluck('element_content', 'element_id');
        })->get()->toArray();

        $PImg = unserialize($Selectedproduct->images);
        foreach ($PImg as $key=>$item) {
            $ProductImages[$key]['img'] = asset('storage/Main/Products/ptype' . $Selectedptype . '/cat' . $Selectedproduct->cat_id . '/products/product' . $Selectedproduct->id . '/p_images/' . $item);
            $ProductImages[$key]['file'] = $item;
        }
//        dd($ProductImages);
        return view('PageElements.Dashboard.Setting.ProductsViewEdit', compact('Selectedproduct', 'product_ptypes', 'Selectedptype', 'ptype_categories', 'ProductImages'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $SelectedProduct = Product::where('id', $request->input('ProductId'))->first();
        $SelectedProduct->cat_id = $request->input('category');
        $ProductImages = unserialize($SelectedProduct->images);
        $ProductImagesPath='Main/Products/ptype' . $request->input('PtypeId') . '/cat' . $request->input('category') . '/products/product' . $request->input('ProductId') . '/p_images/';

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $image) {
                $uploaded=$image;
                $uploaded_filename=$image->getClientOriginalName();
                if(in_array($uploaded_filename,$ProductImages)){
                    unlink('storage/'.$ProductImagesPath.$uploaded_filename); //delete previous uploaded file
                    $OldImgKey = array_search($uploaded_filename, $ProductImages);
                    unset($ProductImages[$OldImgKey]);
                }

                $uploaded->storeAs('public/'.$ProductImagesPath, $uploaded_filename);
                $ProductImages[] = $uploaded_filename;
            }
        }
        $SelectedProduct->images = serialize($ProductImages);
        $SelectedProduct->update();
        return redirect('/Product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product)
    {
        $SelectedProduct = Product::find($product);

        $ProductImages = unserialize($SelectedProduct->images);
        $ProductImagesFolder = 'storage/Main/Products/';
        $ProductCatalogs = new ProductCatalogController();
        $ProductCatalogs->destroy($product);
        foreach ($ProductImages as $item) {
            $this->ProductImgRemove($SelectedProduct->id, $item);
        }
        rmdir($ProductImagesFolder . $SelectedProduct->id); //delete folder
        $SelectedProduct->contents()->delete();
        $SelectedProduct->delete();
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $ProductId
     * @param $productImage
     * @return \Illuminate\Http\Response
     */
    public function ProductImgRemove($ProductId, $productImage)
    {

        $Selectedproduct = Product::where('id', $ProductId)->first();
        $SelectedproductCat=$Selectedproduct->cat_id;
        $SelectedproductPtype=Category::where('id',$SelectedproductCat)->value('ptype_id');

        $ProductImages = unserialize($Selectedproduct->images);
        $ProductImagesPath='storage/Main/Products/ptype' .$SelectedproductPtype . '/cat' . $SelectedproductCat . '/products/product' . $ProductId . '/p_images/';

        $ImageFile = ($ProductImagesPath . $productImage);
        unlink($ImageFile); //delete file
        $ProductImages = serialize(array_values(array_diff($ProductImages, array($productImage)))); //serialize(reindex array(remove selected image()))
        $Selectedproduct->update(['images' => $ProductImages]);
        return back();
    }
}
