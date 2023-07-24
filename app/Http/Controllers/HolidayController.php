<?php

namespace App\Http\Controllers;

use App\Models\Festival;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HolidayController extends Controller
{
    public function index()
    {
        return view('holidays.index', [
            'holidays' => Holiday::with('festival')->orderby('date')->get(),
        ]);
    }


    public function create()
    {
        return view('holidays.add', [
            'festivals' => Festival::get()
        ]);
    }


    public function store(Request $request)
    {
        $messages = [
            'festival_id.unique' => 'This festive holiday already exist',
            'date.unique' => 'This date already associated',
        ];
        $validator = Validator::make($request->all(), [
            'festival_id' => 'required|integer|unique:holidays',
            'date' => 'required|date|unique:holidays|after:'.date('Y-m-d')
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $holiday = new Holiday();
            $holiday->festival_id = $request->festival_id;
            $holiday->date = $request->date;
            $holiday->created_by = Auth::user()->id;
            $holiday->save();
            return redirect()->back()->with('success', 'New holiday created');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Something unexpected happened');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit(Holiday $holiday)
    {
        return view('holidays.edit', [
            'festivals'=>Festival::get(),
            'holiday' => $holiday
        ]);
    }


    public function update(Request $request, Holiday $holiday)
    {
        $messages = [
            'festival_id.unique' => 'This festive holiday already exist',
            'date.unique' => 'This date already associated',
        ];
        $validator = Validator::make($request->all(), [
            'festival_id' => 'required|integer|unique:holidays,festival_id,' . $holiday->id,
            'date' => 'required|date|after:'.date('Y-m-d').'|unique:holidays,date,' . $holiday->id,
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try {
            $holiday->festival_id = $request->festival_id;
            $holiday->date = $request->date;
            $holiday->save();
            return redirect()->route('holidays.all')->with('success', 'Record has been updated');
        } catch (\Throwable $th) {
            // throw $th;
            return redirect()->back()->with('error', 'Something unexpected happened');
        }
    }


    public function destroy(Holiday $holiday)
    {
        try {
            $holiday->delete();
            return redirect()->route('holidays.all')->with('success', 'Record has been deleted');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Something unexpected happened');
        }
    }
}
