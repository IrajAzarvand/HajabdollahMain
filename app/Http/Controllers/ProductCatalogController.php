<?php

namespace App\Http\Controllers;

use App\Models\LocaleContent;
use App\Models\Product;
use App\Models\ProductCatalog;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
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
        return view('PageElements.Dashboard.Setting.Catalog', compact('product_ptypes', 'product_categories'));
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
        if ($request->hasFile('catalog_images')) {
            $Catalog = new ProductCatalog;

            $uploaded = $request->file('catalog_images');
            $filename = time() . '.' . $uploaded->getClientOriginalExtension();  //timestamps.extension
            $uploaded->storeAs('public\Main\Products\ptype' . $request->input('ptype') . '\cat' . $request->input('category') . '\products\product' . $request->input('product') . '\p_catalog\\', $filename);
        }
        $Catalog->product_id = $request->input('product');
        $Catalog->catalog_images = $filename;
        $Catalog->save();


        return redirect('/Catalog');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ProductCatalog $productCatalog
     * @return \Illuminate\Http\Response
     */
    public function show($productCatalog)
    {
        $SelectedProductCatalogs = ProductCatalog::where('product_id', $productCatalog)->value('catalog_images');
        $SelectedProductCatalogs = unserialize($SelectedProductCatalogs);
        $Catalogs = [];
        if ($SelectedProductCatalogs) {
            foreach ($SelectedProductCatalogs as $id => $image) {
                $Catalogs[] = [$id, asset('storage/Main/Products/' . $productCatalog . '/catalogs/' . $image)];
            }
        }
        return $Catalogs;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ProductCatalog $productCatalog
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCatalog $productCatalog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductCatalog $productCatalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCatalog $productCatalog)
    {
        $CatalogImages = unserialize($productCatalog->catalog_images);
        if ($request->hasFile('catalog_images')) {
            $count = 0;
            foreach ($request->file('catalog_images') as $image) {
                $uploaded = $image;
                $filename = $request->input('product') . '_' . time() . $count++ . '.' . $uploaded->getClientOriginalExtension();  //timestamps.extension
                $uploaded->storeAs('public\Main\Products\\' . $request->input('product') . '\catalogs\\', $filename);
                $CatalogImages[] = $filename;
            }
        }
        $productCatalog->catalog_images = serialize($CatalogImages);

        $productCatalog->update();
        return redirect('/Catalog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProductCatalog $productCatalog
     * @return \Illuminate\Http\Response
     */
    public function destroy($productCatalog)
    {
        $SelectedProduct = ProductCatalog::where('product_id', $productCatalog)->first();
        if ($SelectedProduct) {
            $ProductCatalogs = unserialize($SelectedProduct->catalog_images);
            $ProductCatalogsFolder = 'storage/Main/Products/' . $productCatalog . '/catalogs/';


            foreach ($ProductCatalogs as $item) {
                $this->ProductCatalogRemove($productCatalog, $item);
            }
            rmdir($ProductCatalogsFolder); //delete folder
            $SelectedProduct->delete();
        }
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $ProductId
     * @param $catalogImage
     * @return \Illuminate\Http\Response
     */
    public function ProductCatalogRemove($ProductId, $catalogImage)
    {
        $SelectedProduct = ProductCatalog::where('product_id', $ProductId)->first();
        $ProductImages = unserialize($SelectedProduct->catalog_images);
        $ProductImagesFolder = 'storage/Main/Products/' . $ProductId . '/catalogs/';
        $filename = ($ProductImagesFolder . $catalogImage);
        unlink($filename); //delete file
        $ProductImages = serialize(array_values(array_diff($ProductImages, array($catalogImage)))); //serialize(reindex array(remove selected image()))

        $SelectedProduct->update(['catalog_images' => $ProductImages]);
        return back();
    }
}
