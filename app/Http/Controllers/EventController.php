<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\LocaleContent;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Events = Event::with(['contents' => function ($query) {
            $query->where('locale', '=', 'fa')->where('element_title', '=', 'E_Title_fa');
        }])->get();
        $E_List = [];
        foreach ($Events as $key=>$Event) {
            $E_List[$key]['id'] = $Event->id;
            $E_List[$key]['title'] = $Event->contents[0]->element_content;
//            $E_List[$key]['image'] = 'public\Main\Events\\'.$Event->image;
        }
        return view('PageElements.Dashboard.Setting.Events',compact('E_List'));
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
        $NewEvent = new Event();
        $NewEvent->save();
        $E_Id = $NewEvent->id;
        $Contents = [];

        if ($request->E_Title_fa) {
            foreach (Locales() as $item) {
                $Contents[] = new LocaleContent([
                    'page' => 'events',
                    'section' => 'events',
                    'element_id' => $E_Id,
                    'locale' => $item['locale'],
                    'element_title' => 'E_Title_' . $item['locale'],
                    'element_content' => $request->input('E_Title_' . $item['locale']),
                ]);
            }
        }

        if ($request->E_Desc_fa) {
            foreach (Locales() as $item) {
                $Contents[] = new LocaleContent([
                    'page' => 'events',
                    'section' => 'events',
                    'element_id' => $E_Id,
                    'locale' => $item['locale'],
                    'element_title' => 'E_Desc_' . $item['locale'],
                    'element_content' => $request->input('E_Desc_' . $item['locale']),
                ]);
            }
        }

        $NewEvent = Event::find($E_Id);
        $NewEvent->contents()->saveMany($Contents);

        if ($request->hasFile('E_Img')) {
            $uploaded = $request->file('E_Img');
            $filename = $E_Id . '.' . $uploaded->getClientOriginalExtension();
            $uploaded->storeAs('public\Main\Events\\', $filename);
            $NewEvent->image = $filename;
            $NewEvent->update();
        }
        return redirect('/Events');


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
