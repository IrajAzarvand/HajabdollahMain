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
     * @param  \Illuminate\Http\Request  $request
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

        return redirect('/Category');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category)
    {
        $EditCategory = Category::with('contents')->find($category);
        return $EditCategory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach (Locales() as $item) {
            LocaleContent::where(['page' => 'products', 'section' => 'category', 'element_title' => 'category', 'element_id' => $Category->id, 'locale' => $item['locale'],])
                ->update(['element_content' => $request->input($item['locale'])]);
        }
        return redirect('/Category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
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
