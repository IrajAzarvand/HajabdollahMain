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
            $count = 0;
            $images=[];
            foreach ($request->file('product_images') as $file) {
                $uploaded = $file;
                $filename = $count++ . '_' . time() . '.' . $uploaded->getClientOriginalExtension();  //count_timestamps.extension
                $uploaded->storeAs('public\Main\Products\ptype' . $request->input('ptype') . '\cat' . $request->input('category') . '\products\product' . $Product->id . '\p_images\\', $filename);
                $images[]=$filename;
            }
            $Product->images=serialize($images);
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
        $Products=[];
        foreach ($result as $key=>$item){
            $Products[$key]['id']=$item['id'];
            $Products[$key]['ptype']=Category::where('id',$CatID)->value('ptype_id');
            $Products[$key]['image']=asset('storage/Main/Products/ptype'.$Products[$key]['ptype'].'/cat'.$CatID . '/products/product' . $Products[$key]['id'] . '/p_images/'.unserialize($item['images'])[0]);
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
        $Selectedproduct = Product::where('id', $product)->with('contents')->first();
        $product_ptypes = LocaleContent::where(['section' => 'ptype', 'locale' => 'fa', 'element_title' => 'ptype'])->pluck('element_content', 'element_id');
        $Selectedptype = Category::where('id', $Selectedproduct->cat_id)->value('ptype_id');
        $ptype_categories = Category::where('ptype_id', $Selectedptype)->with('contents', function ($query) {
            $query->where('locale', '=', 'fa')
                ->pluck('element_content', 'element_id');
        })->get()->toArray();

        $ProductImages = unserialize($Selectedproduct->images);
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

        $SelectedProduct = Product::where('id', $request->input('ProductId'))->with('contents')->first();
        $element_id = $SelectedProduct->id;

        $SelectedProduct->cat_id = $request->input('category');

        $ProductImages = unserialize($SelectedProduct->images);
        if ($request->hasFile('product_images')) {
            $count = 0;
            foreach ($request->file('product_images') as $image) {
                $uploaded = $image;
                $filename = $element_id . '_' . time() . $count++ . '.' . $uploaded->getClientOriginalExtension();  //timestamps.extension
                $uploaded->storeAs('public\Main\Products\\' . $element_id . '\\', $filename);
                $ProductImages[] = $filename;
            }
        }
        $SelectedProduct->images = serialize($ProductImages);


        if ($request->p_name_fa) {
            foreach (Locales() as $item) {
                $SelectedProduct->contents()->updateOrInsert(
                    [
                        'page' => 'products',
                        'section' => 'products',
                        'element_id' => $element_id,
                        'locale' => $item['locale'],
                        'element_title' => 'p_name_' . $item['locale'],
                    ],
                    [
                        'element_content' => $request->input('p_name_' . $item['locale']),
                    ]
                );
            }
        }


        if ($request->p_introduction_fa) {
            foreach (Locales() as $item) {
                $SelectedProduct->contents()->updateOrInsert(
                    [
                        'page' => 'products',
                        'section' => 'products',
                        'element_id' => $element_id,
                        'locale' => $item['locale'],
                        'element_title' => 'p_introduction_' . $item['locale'],
                    ],
                    [
                        'element_content' => $request->input('p_introduction_' . $item['locale']),
                    ]
                );
            }
        }

        if ($request->nutritionalValue_fa) {
            foreach (Locales() as $item) {
                $SelectedProduct->contents()->updateOrInsert(
                    [
                        'page' => 'products',
                        'section' => 'products',
                        'element_id' => $element_id,
                        'locale' => $item['locale'],
                        'element_title' => 'nutritionalValue_' . $item['locale'],
                    ],
                    [
                        'element_content' => $request->input('nutritionalValue_' . $item['locale']),
                    ]
                );
            }
        }


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
        $ProductImages = unserialize($Selectedproduct->images);
        $ProductImagesFolder = 'storage/Main/Products/';
        $filename = ($ProductImagesFolder . $ProductId . '/' . $productImage);
        unlink($filename); //delete file
        $ProductImages = serialize(array_values(array_diff($ProductImages, array($productImage)))); //serialize(reindex array(remove selected image()))
        $Selectedproduct->update(['images' => $ProductImages]);
        return back();
    }
}
