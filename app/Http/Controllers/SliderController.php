<?php

namespace App\Http\Controllers;

use App\Models\LocaleContent;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        foreach (Locales() as $key=>$item) {

            $lang[$key]['name']=$item['name'];
            $lang[$key]['locale']=$item['locale'];
        }

        $Sliders = Slider::with('contents')->get()->sortKeysDesc();
        return view('PageElements.Dashboard.Setting.Slider', compact('Sliders','lang'));
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
        $rules = [
            'SliderImage' => ['required', 'max:49999', 'mimes:jpg,jpeg,png'],
        ];

        $this->validate($request, $rules);
        $Slider = new Slider;
        $filename = '';

        if ($request->hasFile('SliderImage')) {
            $uploaded = $request->file('SliderImage');
            $filename = time() . '.' . $uploaded->getClientOriginalExtension();  //timestamps.extension
            $uploaded->storeAs('public\Main\Sliders\\', $filename);
        }

        $Slider->image = $filename;
        $Slider->save();
        return redirect('/Slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($slider)
    {

        $slider = per_digit_conv($slider);
        $EditSlider = Slider::with('contents')->find($slider);
        return view('PageElements.Dashboard.Setting.SliderEdit', compact('EditSlider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $filename = $request->input('OldSliderImage');
        if ($request->hasFile('SliderImage')) {
            //remove previous file
            $filename = ('storage/Main/Sliders/' . $filename);
            unlink($filename);
            //store new file
            $uploaded = $request->file('SliderImage');
            $filename = time() . '.' . $uploaded->getClientOriginalExtension();  //timestamps.extension
            $uploaded->storeAs('public\Main\Sliders\\', $filename);
        }


        $Slider = Slider::find($request->input('SliderId'));
        $Slider->image = $filename;
        $Slider->save();
        return redirect('/Slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($slider)
    {
        $id = per_digit_conv($slider);
        $Slider = Slider::find($id);
        $filename = ('storage/Main/Sliders/' . $Slider['image']);
        unlink($filename);
        $Slider->delete();
    }
}
