<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
        $P_Catalog = ProductCatalog::firstWhere('product_id', $request->input('product'));
        if ($P_Catalog) {
            //admin wants to update an existing catalog
            $this->update($request, $P_Catalog);
        } else {
            //create new catalog
            if ($request->hasFile('catalog_images')) {
                $Catalog = new ProductCatalog;
                foreach ($request->file('catalog_images') as $file) {
                    $filename = $file->getClientOriginalName();
                    $uploaded = $file;
                    $uploaded->storeAs('public\Main\Products\ptype' . $request->input('ptype') . '\cat' . $request->input('category') . '\products\product' . $request->input('product') . '\p_catalog\\', $filename);
                    $images[] = $filename;
                }
            }
            $Catalog->product_id = $request->input('product');
            $Catalog->catalog_images = serialize($images);
            $Catalog->save();
        }
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
        $SelectedProduct = Product::find($productCatalog);
        $P_Cat = $SelectedProduct->cat_id;
        $P_Ptype = Category::where('id', $P_Cat)->value('ptype_id');
        $SelectedProductCatalogs = ProductCatalog::where('product_id', $productCatalog)->first();
        $Catalog = [];
        if ($SelectedProductCatalogs) {
            $Cat_Images = unserialize($SelectedProductCatalogs->catalog_images);
            foreach ($Cat_Images as $key => $catalog) {
                $Catalog[$key]['img'] = asset('storage/Main/Products/ptype' . $P_Ptype . '/cat' . $P_Cat . '/products/product' . $SelectedProduct->id . '/p_catalog/' . $catalog);
                $Catalog[$key]['filename'] = $catalog;
            }
        }
        return $Catalog;
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
        $SelectedCatalog = ProductCatalog::where('product_id', $request->input('product'))->first();
        $CatalogImages = unserialize($SelectedCatalog->catalog_images);
        $ProductCatalogPath = 'Main/Products/ptype' . $request->input('ptype') . '/cat' . $request->input('category') . '/products/product' . $request->input('product') . '/p_catalog/';

        if ($request->hasFile('catalog_images')) {
            foreach ($request->file('catalog_images') as $image) {
                $uploaded = $image;
                $uploaded_filename = $image->getClientOriginalName();
                if (in_array($uploaded_filename, $CatalogImages)) {
                    unlink('storage/' . $ProductCatalogPath . $uploaded_filename); //delete previous uploaded file
                    $OldCatKey = array_search($uploaded_filename, $CatalogImages);
                    unset($CatalogImages[$OldCatKey]);
                }

                $uploaded->storeAs('public/' . $ProductCatalogPath, $uploaded_filename);
                $CatalogImages[] = $uploaded_filename;
            }
        }
        $SelectedCatalog->catalog_images = serialize(array_values($CatalogImages));
        $SelectedCatalog->update();
        return redirect('/Catalog');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ProductCatalog $productCatalog
     * @return bool
     */
    public function destroy($productCatalog)
    {

//        $CatalogProductCategory = Product::where('id', $productCatalog->product_id)->value('cat_id');
//        $CatalogProductPtype = Category::where('id', $CatalogProductCategory)->value('ptype_id');
//        $Catalog_ImgPath = 'Main\Products\ptype' . $CatalogProductPtype . '\cat' . $CatalogProductCategory . '\products\product' . $productCatalog->product_id . '\p_catalog\\';
//
//        if ($productCatalog) {
//            $CatalogImage = $productCatalog->catalog_images;
//            $this->ProductCatalogRemove($productCatalog->product_id, $CatalogImage);
//            $productCatalog->delete();
//        }
//        return true;
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
        $SelectedCatalog = ProductCatalog::where('product_id', $ProductId)->first();
        $CatalogProductCategory = Product::where('id', $ProductId)->value('cat_id');
        $CatalogProductPtype = Category::where('id', $CatalogProductCategory)->value('ptype_id');
        $catalogPath = 'Main\Products\ptype' . $CatalogProductPtype . '\cat' . $CatalogProductCategory . '\products\product' . $ProductId . '\p_catalog\\';
        unlink('storage\\' . $catalogPath . $catalogImage); //delete file

        //remove from DB
        $CatalogImages = unserialize($SelectedCatalog->catalog_images);
        $UpdatedCatalogImages = serialize(array_values(array_diff($CatalogImages, array($catalogImage)))); //serialize(reindex array(remove selected image()))
        $SelectedCatalog->update(['catalog_images' => $UpdatedCatalogImages]);
        return back();
    }
}
