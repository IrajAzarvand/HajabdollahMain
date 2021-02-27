<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\LocaleContent;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AboutUss = AboutUs::with(['contents' => function ($query) {
            $query->where('locale', '=', 'fa');
        }])->get();

        $AboutUsList = [];
        foreach ($AboutUss as $key=>$AboutUs) {
            $AboutUsList[$key]['id'] = $AboutUs->id;
            $AboutUsList[$key]['title'] = $AboutUs->contents[0]->element_content;
        }
        return view('PageElements.Dashboard.Setting.AboutUs',compact('AboutUsList'));
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

        $AboutUs = new AboutUs;
        $AboutUs->save();
        $element_id = $AboutUs->id;
        $Contents = [];

        if ($request->AboutUsDescription_fa) {
            foreach (Locales() as $item) {
                $Contents[] = new LocaleContent([
                    'page' => 'AboutUs',
                    'section' => 'AboutUs',
                    'element_id' => $element_id,
                    'locale' => $item['locale'],
                    'element_title' => 'AboutUsDescription_' . $item['locale'],
                    'element_content' => $request->input('AboutUsDescription_' . $item['locale']),
                ]);
            }
        }

        $NewAboutUs = AboutUs::find($element_id);
        $NewAboutUs->contents()->saveMany($Contents);
        $NewAboutUs->update();

        return redirect('/AboutUs');
    }

    /**
     * Display the speAboutUsfied resource.
     *
     * @param  \App\Models\AboutUs  $AboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUs $AboutUs)
    {
        //
    }

    /**
     * Show the form for editing the speAboutUsfied resource.
     *
     * @param  \App\Models\AboutUs  $AboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit($AboutUs)
    {
        $SelectedAboutUs =AboutUs::where('id', $AboutUs)->with('contents')->first();
        return $SelectedAboutUs;
    }

    /**
     * Update the speAboutUsfied resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUs  $AboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $SelectedAboutUs = AboutUs::where('id', $request->input('AboutUs_Id'))->with('contents')->first();
        $element_id = $SelectedAboutUs->id;

        if ($request->AboutUs_Desc_fa) {
            foreach (Locales() as $item) {
                $SelectedAboutUs->contents()->updateOrInsert(
                    [
                        'page' => 'AboutUs',
                        'section' => 'AboutUs',
                        'element_id' => $element_id,
                        'locale' => $item['locale'],
                        'element_title' => 'AboutUsDescription_' . $item['locale'],
                    ],
                    [
                        'element_content' => $request->input('AboutUs_Desc_' . $item['locale']),
                    ]
                );
            }
        }

        $SelectedAboutUs->update();
        return redirect('/AboutUs');
    }

    /**
     * Remove the speAboutUsfied resource from storage.
     *
     * @param  \App\Models\AboutUs  $AboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy($AboutUs)
    {
        $SelectedAboutUs = AboutUs::find($AboutUs);
        $SelectedAboutUs->contents()->delete();
        $SelectedAboutUs->delete();
        return true;
    }
}
