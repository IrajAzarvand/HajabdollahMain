<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\LocaleContent;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Addresses = Address::with(['contents' => function ($query) {
            $query->where('locale', '=', 'fa');
        }])->get();

        $ADList = [];
        foreach ($Addresses as $key=>$AD) {
            $ADList[$key]['id'] = $AD->id;
            $ADList[$key]['title'] = $AD->contents[0]->element_content;
        }
        return view('PageElements.Dashboard.Setting.Address',compact('ADList'));
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
        $Address = new Address();
        $Address->save();
        $element_id = $Address->id;
        $Contents = [];

        if ($request->AddressDescription_fa) {
            foreach (Locales() as $item) {
                $Contents[] = new LocaleContent([
                    'page' => 'CU',
                    'section' => 'Address',
                    'element_id' => $element_id,
                    'locale' => $item['locale'],
                    'element_title' => 'AddressDescription_' . $item['locale'],
                    'element_content' => $request->input('AddressDescription_' . $item['locale']),
                ]);
            }
        }

        $NewAddress = Address::find($element_id);
        $NewAddress->contents()->saveMany($Contents);
        $NewAddress->update();

        return redirect('/Address');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit($address)
    {
        $SelectedAddress =Address::where('id', $address)->with('contents')->first();
        return $SelectedAddress;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $SelectedAddress = Address::where('id', $request->input('Address_Id'))->with('contents')->first();
        $element_id = $SelectedAddress->id;

        if ($request->Address_Desc_fa) {
            foreach (Locales() as $item) {
                $SelectedAddress->contents()->updateOrInsert(
                    [
                        'page' => 'CU',
                        'section' => 'Address',
                        'element_id' => $element_id,
                        'locale' => $item['locale'],
                        'element_title' => 'AddressDescription_' . $item['locale'],
                    ],
                    [
                        'element_content' => $request->input('Address_Desc_' . $item['locale']),
                    ]
                );
            }
        }

        $SelectedAddress->update();
        return redirect('/Address');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy($address)
    {
        $SelectedAddress = Address::find($address);
        $SelectedAddress->contents()->delete();
        $SelectedAddress->delete();
        return true;
    }
}
