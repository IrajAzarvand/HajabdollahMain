<?php

namespace App\Http\Controllers;

use App\Models\CU;
use App\Models\LocaleContent;
use Illuminate\Http\Request;

class CUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CUs = CU::with(['contents' => function ($query) {
            $query->where('locale', '=', 'fa');
        }])->get();

        $CUList = [];
        foreach ($CUs as $key=>$CU) {
            $CUList[$key]['id'] = $CU->id;
            $CUList[$key]['title'] = $CU->contents[0]->element_content;
        }
        return view('PageElements.Dashboard.Setting.CU',compact('CUList'));
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
        $CU = new CU;
        $CU->save();
        $element_id = $CU->id;
        $Contents = [];

        if ($request->CUDescription_fa) {
            foreach (Locales() as $item) {
                $Contents[] = new LocaleContent([
                    'page' => 'CU',
                    'section' => 'CU',
                    'element_id' => $element_id,
                    'locale' => $item['locale'],
                    'element_title' => 'CUDescription_' . $item['locale'],
                    'element_content' => $request->input('CUDescription_' . $item['locale']),
                ]);
            }
        }

        $NewCU = CU::find($element_id);
        $NewCU->contents()->saveMany($Contents);
        $NewCU->update();

        return redirect('/CU');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CU  $cU
     * @return \Illuminate\Http\Response
     */
    public function show(CU $cU)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CU  $cU
     * @return \Illuminate\Http\Response
     */
    public function edit($cU)
    {
        $SelectedCU =CU::where('id', $cU)->with('contents')->first();
        return $SelectedCU;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CU  $cU
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $SelectedCU = CU::where('id', $request->input('CU_Id'))->with('contents')->first();
        $element_id = $SelectedCU->id;

        if ($request->CU_Desc_fa) {
            foreach (Locales() as $item) {
                $SelectedCU->contents()->updateOrInsert(
                    [
                        'page' => 'CU',
                        'section' => 'CU',
                        'element_id' => $element_id,
                        'locale' => $item['locale'],
                        'element_title' => 'CUDescription_' . $item['locale'],
                    ],
                    [
                        'element_content' => $request->input('CU_Desc_' . $item['locale']),
                    ]
                );
            }
        }

        $SelectedCU->update();
        return redirect('/CU');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CU  $CU
     * @return \Illuminate\Http\Response
     */
    public function destroy($CU)
    {
        $SelectedCU = CU::find($CU);
        $SelectedCU->contents()->delete();
        $SelectedCU->delete();
        return true;
    }
}
