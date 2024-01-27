<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHealthRecordsInfoRequest;
use App\Http\Requests\UpdateHealthRecordsInfoRequest;
use App\Models\HealthRecordsInfo;
use Carbon\Carbon;

class HealthRecordsInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('health_records')->with('healthRecordsInfo', HealthRecordsInfo::orderby('health-date', 'desc')->paginate(10));
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
     * @param  \App\Http\Requests\StoreHealthRecordsInfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHealthRecordsInfoRequest $request)
    {
        //
        $input = $request->all();

        $today = Carbon::now()->format('Y-m-d');

        $image_breakfast = $request->file('health-breakfast-img');

        if ($image_breakfast) {
            $filename = time() . '_' . $image_breakfast->getClientOriginalName();
            $image_breakfast->move(public_path('uploads/images/health-breakfast-img/'.$today), $filename);

            $input['health-breakfast-img'] = 'images/health-breakfast-img/'.$today . '/' . $filename;
        } else {
            $input['health-breakfast-img'] = '';
        }

        $image_lunch = $request->file('health-lunch-img');

        if ($image_lunch) {
            $filename = time() . '_' . $image_lunch->getClientOriginalName();
            $image_lunch->move(public_path('uploads/images/health-lunch-img/'.$today), $filename);

            $input['health-lunch-img'] = 'images/health-lunch-img/'.$today . '/' . $filename;
        } else {
            $input['health-lunch-img'] = '';
        }

        $image_dinner = $request->file('health-dinner-img');

        if ($image_dinner) {
            $filename = time() . '_' . $image_dinner->getClientOriginalName();
            $image_dinner->move(public_path('uploads/images/health-dinner-img/'.$today), $filename);

            $input['health-dinner-img'] = 'images/health-dinner-img/'.$today . '/' . $filename;
        } else {
            $input['health-dinner-img'] = '';
        }

        $image_bedtime_snacks = $request->file('health-bedtime-snacks-img');

        if ($image_bedtime_snacks) {
            $filename = time() . '_' . $image_bedtime_snacks->getClientOriginalName();
            $image_bedtime_snacks->move(public_path('uploads/images/health-bedtime-snacks-img/'.$today), $filename);

            $input['health-bedtime-snacks-img'] = 'images/health-bedtime-snacks-img/'.$today . '/' . $filename;
        } else {
            $input['health-bedtime-snacks-img'] = '';
        }

        HealthRecordsInfo::create($input);

        return redirect(route('health-records.reports'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HealthRecordsInfo  $healthRecordsInfo
     * @return \Illuminate\Http\Response
     */
    public function show(HealthRecordsInfo $healthRecordsInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HealthRecordsInfo  $healthRecordsInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(HealthRecordsInfo $healthRecordsInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHealthRecordsInfoRequest  $request
     * @param  \App\Models\HealthRecordsInfo  $healthRecordsInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHealthRecordsInfoRequest $request, HealthRecordsInfo $healthRecordsInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HealthRecordsInfo  $healthRecordsInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(HealthRecordsInfo $healthRecordsInfo)
    {
        //
    }
}
