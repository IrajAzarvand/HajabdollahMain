<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LocaleContent;
use App\Models\Product;
use App\Models\PType;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

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

        $element_id = $Category->id;

        $Contents = [];
        foreach (Locales() as $item) {
            $Contents[] = new LocaleContent([
                'page' => 'products',
                'section' => 'category',
                'element_id' => $element_id,
                'locale' => $item['locale'],
                'element_title' => 'category',
                'element_content' => $request->input($item['locale']),
            ]);
        }
        $NewCat = Category::find($element_id);
        $NewCat->contents()->saveMany($Contents);

        $ptypeId = $request->input('ptype');

        if ($request->hasFile('CatImg')) {
            $uploaded = $request->file('CatImg');
            $filename = $element_id . '.' . $uploaded->getClientOriginalExtension();
            $uploaded->storeAs('public\Main\Products\ptype' . $ptypeId . '\cat' . $Category->id . '\\cat_img\\', $filename);
            $NewCat = Category::find($Category->id);
            $NewCat->cat_image = $filename;
            $NewCat->update();
        }
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
        $result = Category::where('ptype_id', $PType)->with('contents')->get()->pluck('contents');
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $SelectedCategory = Category::with('contents')->find($category);
        $SelectedCategory->cat_image = asset('storage/Main/Products/ptype' . $SelectedCategory->ptype_id . '/cat' . $SelectedCategory->id . '/cat_img/' . $SelectedCategory->cat_image);
        return $SelectedCategory;
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
        if ($request->hasFile('Cat_New_Img')) {

            //remove previous cat image
            $PrevCatImg = 'storage/Main/Products/ptype' . $Category->ptype_id . '/cat' . $Category->id . '/cat_img/' . $Category->cat_image;
            unlink($PrevCatImg);

            //save newly uploaded file
            $uploaded = $request->file('Cat_New_Img');
            $filename = $Category->id . '.' . $uploaded->getClientOriginalExtension();
            $uploaded->storeAs('public\Main\Products\ptype' . $Category->ptype_id . '\cat' . $Category->id . '\cat_img\\', $filename);
            $Category->cat_image;
            $Category->update();
        }

        return redirect('/Category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return bool
     */
    public function destroy($category)
    {
        $id = per_digit_conv($category);
        $Category = Category::find($id);
        $CatPtype=$Category->ptype_id;
        $CatImg=$Category->cat_image;
        $CategoryProducts = Product::where('cat_id', $Category->id)->get();

        if ($CategoryProducts) {
            $product = new ProductController;
            foreach ($CategoryProducts as $Product) {
                $product->destroy($Product->id);
            }
        }

        $CategoryImagPath='storage/Main/Products/ptype' . $CatPtype . '/cat' . $Category->id . '/cat_img/' . $CatImg;
        $CategoryfolderPath='storage/Main/Products/ptype' . $CatPtype . '/cat' . $Category->id . '/cat_img/';
        $CategoryProductsFolder='storage/Main/Products/ptype' . $CatPtype . '/cat' . $Category->id .'products';
        $CategoryFolder='storage/Main/Products/ptype' . $CatPtype . '/cat' . $Category->id;
        unlink($CategoryImagPath);
        rmdir($CategoryfolderPath);
        rmdir($CategoryProductsFolder);
        rmdir($CategoryFolder);
        $Category->contents()->delete();
        $Category->delete();
        return true;
    }
}
