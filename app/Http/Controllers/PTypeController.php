<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LocaleContent;
use App\Models\PType;
use Illuminate\Http\Request;

class PTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PTypes = PType::with('contents')->get();

        return view('PageElements.Dashboard.Setting.PType', compact('PTypes'));
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
        $PTypes = new PType;
        $PTypes->save();
        $element_id = $PTypes->id;
        $Contents = [];
        foreach (Locales() as $item) {
            $Contents[] = new LocaleContent([
                'page' => 'products',
                'section' => 'ptype',
                'element_id' => $element_id,
                'locale' => $item['locale'],
                'element_title' => 'ptype',
                'element_content' => $request->input($item['locale']),
            ]);
        }
        $NewPType = PType::find($element_id);
        $NewPType->contents()->saveMany($Contents);

        return redirect('/PType');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PType  $pType
     * @return \Illuminate\Http\Response
     */
    public function show(PType $pType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PType  $pType
     * @return \Illuminate\Http\Response
     */
    public function edit($pType)
    {
        $EditPType = PType::with('contents')->find($pType);
        return $EditPType;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PType  $pType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $PType = PType::find($request->input('PTypeId'));

        foreach (Locales() as $item) {
            LocaleContent::where(['page' => 'products', 'section' => 'ptype', 'element_title' => 'ptype', 'element_id' => $PType->id, 'locale' => $item['locale'],])
                ->update(['element_content' => $request->input($item['locale'])]);
        }
        return redirect('/PType');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PType  $pType
     * @return \Illuminate\Http\Response
     */
    public function destroy($pType)
    {
        $SelectedPType = PType::find($pType);
        $categories = Category::where('ptype_id', $pType)->get();

        $category = new CategoryController();

        foreach ($categories as $c) {
            $category->destroy($c->id);

        }
        $SelectedPType->categories()->delete();
        $SelectedPType->contents()->delete();
        $SelectedPType->delete();
    }
}
