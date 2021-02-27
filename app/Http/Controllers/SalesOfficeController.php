<?php

namespace App\Http\Controllers;

use App\Models\LocaleContent;
use App\Models\SalesOffice;
use Illuminate\Http\Request;

class SalesOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $SalesOffices = SalesOffice::with(['contents' => function ($query) {
            $query->where('locale', '=', 'fa');
        }])->get();

        $OList = [];
        foreach ($SalesOffices as $key=>$office) {
            $OList[$key]['id'] = $office->id;
            $OList[$key]['title'] = $office->contents[0]->element_content;
        }

        return view('PageElements.Dashboard.Setting.SalesOffice',compact('OList'));
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
        //        $SO = new SalesOffice();
//        $SO->save();
//        $element_id = $SO->id;
//        $Contents = [];
//        if ($request->SalesOffice_fa) {
//            foreach (Locales() as $item) {
//                $Contents[] = new LocaleContent([
//                    'page' => 'sales_office',
//                    'section' => 'sales_office',
//                    'element_id' => $element_id,
//                    'locale' => $item['locale'],
//                    'element_title' => 'SalesOffice_' . $item['locale'],
//                    'element_content' => $request->input('SalesOffice_' . $item['locale']),
//                ]);
//            }
//        }
//        $NewSO = SalesOffice::find($element_id);
//        $NewSO->contents()->saveMany($Contents);
//        return redirect('/SO');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalesOffice  $salesOffice
     * @return \Illuminate\Http\Response
     */
    public function show(SalesOffice $salesOffice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalesOffice  $salesOffice
     * @return \Illuminate\Http\Response
     */
    public function edit($salesOffice)
    {
        $EditSO = SalesOffice::with('contents')->find($salesOffice);
        return $EditSO;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalesOffice  $salesOffice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $SO = SalesOffice::find($request->input('OfficeId'));

        foreach (Locales() as $item) {
            LocaleContent::where(['page' => 'sales_office', 'section' => 'sales_office', 'locale'=>$item['locale'], 'element_id' => $SO->id])
                ->update(['element_content' => $request->input($item['locale'])]);
        }
        return redirect('/SO');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalesOffice  $salesOffice
     * @return \Illuminate\Http\Response
     */
    public function destroy($salesOffice)
    {
        $SelectedSO = SalesOffice::find($salesOffice);
        $SelectedSO->contents()->delete();
        $SelectedSO->delete();
    }
}
