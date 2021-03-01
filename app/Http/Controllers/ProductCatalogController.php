<?php

namespace App\Http\Controllers;

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
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCatalog  $productCatalog
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCatalog $productCatalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCatalog  $productCatalog
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCatalog $productCatalog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCatalog  $productCatalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCatalog $productCatalog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCatalog  $productCatalog
     * @return \Illuminate\Http\Response
     */
    public function destroy($productCatalog)
    {
        $SelectedProduct = ProductCatalog::where('product_id',$productCatalog)->first();
        if($SelectedProduct){
            $ProductCatalogs = unserialize($SelectedProduct->catalog_images);
            $ProductCatalogsFolder = 'storage/Main/Products/'.$productCatalog.'/catalogs/';


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
        $SelectedProduct=ProductCatalog::where('product_id',$ProductId)->first();
        $ProductImages=unserialize($SelectedProduct->catalog_images);
        $ProductImagesFolder = 'storage/Main/Products/'.$ProductId.'/catalogs/';
        $filename = ( $ProductImagesFolder.$catalogImage);
        unlink($filename); //delete file
        $ProductImages = serialize(array_values(array_diff($ProductImages, array($catalogImage)))); //serialize(reindex array(remove selected image()))

        $SelectedProduct->update(['catalog_images' => $ProductImages]);
        return back();
    }
}
