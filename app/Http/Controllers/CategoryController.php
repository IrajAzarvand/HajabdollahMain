<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LocaleContent;
use App\Models\Product;
use App\Models\PType;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PTypes = PType::with('contents')->get();
        return view('PageElements.Dashboard.Setting.Categories', compact('PTypes'));
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
        $Category = new Category;
        $Category->ptype_id = $request->input('ptype');
        $Category->save();
        $ptypeId = $request->input('ptype');
        $CatImages = [];
        foreach (Locales() as $item) {
            if ($request->hasFile('CatImg_' . $item['locale'])) {
                $uploaded = $request->file('CatImg_' . $item['locale']);
            }
            $filename = $item['locale'] . '.' . $uploaded->getClientOriginalExtension();  //locale.extension
            $uploaded->storeAs('public\Main\Products\ptype' . $ptypeId . '\cat' . $Category->id . '\\cat_img\\', $filename);
            $CatImages[] = $filename;
        }
        $NewCat = Category::find($Category->id);
        $NewCat->cat_image = serialize($CatImages);
        $NewCat->update();
        return redirect('/Category');
    }

    /**
     * Display the specified resource.
     *
     * @param $PType
     * @return \Illuminate\Http\Response
     */
    public function show($PType)
    {

        $SelectedCategories = Category::where('ptype_id', $PType)->get();
        $Images = [];
        foreach ($SelectedCategories as $Cat) {
            $CatImgs = [];
            $CatImgs[$Cat->id] = unserialize($Cat->cat_image);
            foreach ($CatImgs as $key => $ImgArray) {
                foreach ($ImgArray as $item) {
                    $Images[] = [$PType, $key, asset('storage/Main/Products/ptype' . $PType . '/cat' . $key . '/cat_img/' . $item)];
                }

            }
        }
        return $Images;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @param $filename
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $SelectedCategory = Category::find($category);
        $C_PtypeId=$SelectedCategory->ptype_id;
        $C_Images=unserialize($SelectedCategory->cat_image);
        foreach ($C_Images as $key=>$c_Image){
            $C_Images[$key]=asset('storage/Main/Products/ptype' . $C_PtypeId . '/cat' . $category . '/cat_img/' . $c_Image);
        }
        return $C_Images;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Category = Category::find($request->input('CatId'));
        foreach (Locales() as $item) {
            LocaleContent::where(['page' => 'products', 'section' => 'category', 'element_title' => 'category', 'element_id' => $Category->id, 'locale' => $item['locale'],])
                ->update(['element_content' => $request->input($item['locale'])]);
        }
        return redirect('/Category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $id = per_digit_conv($category);

        $Category = Category::find($id);

        $CategoryProducts = Product::where('cat_id', $Category->id)->get();

        $product = new ProductController;
        foreach ($CategoryProducts as $Product) {
            $product->destroy($Product->id);
        }
        $Category->contents()->delete();
        $Category->delete();
    }
}
