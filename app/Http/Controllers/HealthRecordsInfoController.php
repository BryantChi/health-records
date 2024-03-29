<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHealthRecordsInfoRequest;
use App\Http\Requests\UpdateHealthRecordsInfoRequest;
use App\Models\HealthRecordsInfo;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
// use Intervention\Image\Image;
use Illuminate\Support\Facades\File;

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
            $path = public_path('uploads/images/health-breakfast-img/'.$today) . '/';
            $filename = time() . '_' . $image_breakfast->getClientOriginalName();
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            // 壓縮圖片
            $image_breakfast = Image::make($image_breakfast)->orientate()->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 75); // 設定 JPG 格式和 75% 品質
            $image_breakfast->save($path.$filename);

            $input['health-breakfast-img'] = 'images/health-breakfast-img/'.$today . '/' . $filename;
        } else {
            $input['health-breakfast-img'] = '';
        }

        $image_lunch = $request->file('health-lunch-img');

        if ($image_lunch) {
            $path = public_path('uploads/images/health-lunch-img/'.$today) . '/';
            $filename = time() . '_' . $image_lunch->getClientOriginalName();
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            // 壓縮圖片
            $image_lunch = Image::make($image_lunch)->orientate()->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 75); // 設定 JPG 格式和 75% 品質
            $image_lunch->save($path.$filename);

            $input['health-lunch-img'] = 'images/health-lunch-img/'.$today . '/' . $filename;
        } else {
            $input['health-lunch-img'] = '';
        }

        $image_dinner = $request->file('health-dinner-img');

        if ($image_dinner) {
            $path = public_path('uploads/images/health-dinner-img/'.$today) . '/';
            $filename = time() . '_' . $image_dinner->getClientOriginalName();
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            // 壓縮圖片
            $image_dinner = Image::make($image_dinner)->orientate()->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 75); // 設定 JPG 格式和 75% 品質
            $image_dinner->save($path.$filename);

            $input['health-dinner-img'] = 'images/health-dinner-img/'.$today . '/' . $filename;
        } else {
            $input['health-dinner-img'] = '';
        }

        $image_bedtime_snacks = $request->file('health-bedtime-snacks-img');

        if ($image_bedtime_snacks) {
            $path = public_path('uploads/images/health-bedtime-snacks-img/'.$today) . '/';
            $filename = time() . '_' . $image_bedtime_snacks->getClientOriginalName();
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            // 壓縮圖片
            $image_bedtime_snacks = Image::make($image_bedtime_snacks)->orientate()->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 75); // 設定 JPG 格式和 75% 品質
            $image_bedtime_snacks->save($path.$filename);

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
    public function edit($id)
    {
        //
        $healthRecordsInfo = HealthRecordsInfo::find($id);
        return view('health_records_edit')->with('healthRecordsInfo', $healthRecordsInfo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHealthRecordsInfoRequest  $request
     * @param  \App\Models\HealthRecordsInfo  $healthRecordsInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHealthRecordsInfoRequest $request)
    {
        //
        $input = $request->all();

        $healthRecordsInfo = HealthRecordsInfo::find($input['id']);

        $image_breakfast = $request->file('health-breakfast-img');

        if ($image_breakfast) {
            $path = public_path('uploads/images/health-breakfast-img/'.$healthRecordsInfo['health-date']) . '/';
            $filename = time() . '_' . $image_breakfast->getClientOriginalName();
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            if ($healthRecordsInfo['health-breakfast-img'] != null) {
                // 若已存在，則覆蓋原有圖片
                if (File::exists(public_path('uploads/' . $healthRecordsInfo['health-breakfast-img']))) {
                    File::delete(public_path('uploads/' . $healthRecordsInfo['health-breakfast-img']));
                }
            }
            // 壓縮圖片
            $image_breakfast = Image::make($image_breakfast)->orientate()->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 75); // 設定 JPG 格式和 75% 品質
            $image_breakfast->save($path.$filename);



            $input['health-breakfast-img'] = 'images/health-breakfast-img/'.$healthRecordsInfo['health-date'] . '/' . $filename;
        } else {
            $input['health-breakfast-img'] = $healthRecordsInfo['health-breakfast-img'];
        }

        $image_lunch = $request->file('health-lunch-img');

        if ($image_lunch) {
            $path = public_path('uploads/images/health-lunch-img/'.$healthRecordsInfo['health-date']) . '/';
            $filename = time() . '_' . $image_lunch->getClientOriginalName();
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            if ($healthRecordsInfo['health-lunch-img'] != null) {
                // 若已存在，則覆蓋原有圖片
                if (File::exists(public_path('uploads/' . $healthRecordsInfo['health-lunch-img']))) {
                    File::delete(public_path('uploads/' . $healthRecordsInfo['health-lunch-img']));
                }
            }
            // 壓縮圖片
            $image_lunch = Image::make($image_lunch)->orientate()->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 75); // 設定 JPG 格式和 75% 品質
            $image_lunch->save($path.$filename);

            $input['health-lunch-img'] = 'images/health-lunch-img/'.$healthRecordsInfo['health-date'] . '/' . $filename;
        } else {
            $input['health-lunch-img'] = $healthRecordsInfo['health-lunch-img'];
        }

        $image_dinner = $request->file('health-dinner-img');

        if ($image_dinner) {
            $path = public_path('uploads/images/health-dinner-img/'.$healthRecordsInfo['health-date']) . '/';
            $filename = time() . '_' . $image_dinner->getClientOriginalName();
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            if ($healthRecordsInfo['health-dinner-img'] != null) {
                // 若已存在，則覆蓋原有圖片
                if (File::exists(public_path('uploads/' . $healthRecordsInfo['health-dinner-img']))) {
                    File::delete(public_path('uploads/' . $healthRecordsInfo['health-dinner-img']));
                }
            }
            // 壓縮圖片
            $image_dinner = Image::make($image_dinner)->orientate()->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 75); // 設定 JPG 格式和 75% 品質
            $image_dinner->save($path.$filename);

            $input['health-dinner-img'] = 'images/health-dinner-img/'.$healthRecordsInfo['health-date'] . '/' . $filename;
        } else {
            $input['health-dinner-img'] = $healthRecordsInfo['health-dinner-img'];
        }

        $image_bedtime_snacks = $request->file('health-bedtime-snacks-img');

        if ($image_bedtime_snacks) {
            $path = public_path('uploads/images/health-bedtime-snacks-img/'.$healthRecordsInfo['health-date']) . '/';
            $filename = time() . '_' . $image_bedtime_snacks->getClientOriginalName();
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            if ($healthRecordsInfo['health-bedtime-snacks-img'] != null) {
                // 若已存在，則覆蓋原有圖片
                if (File::exists(public_path('uploads/' . $healthRecordsInfo['health-bedtime-snacks-img']))) {
                    File::delete(public_path('uploads/' . $healthRecordsInfo['health-bedtime-snacks-img']));
                }
            }
            // 壓縮圖片
            $image_bedtime_snacks = Image::make($image_bedtime_snacks)->orientate()->resize(800, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('jpg', 75); // 設定 JPG 格式和 75% 品質
            $image_bedtime_snacks->save($path.$filename);

            $input['health-bedtime-snacks-img'] = 'images/health-bedtime-snacks-img/'.$healthRecordsInfo['health-date'] . '/' . $filename;
        } else {
            $input['health-bedtime-snacks-img'] = $healthRecordsInfo['health-bedtime-snacks-img'];
        }

        $healthRecordsInfo->update($input);

        return redirect(route('health-records.reports'));
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
