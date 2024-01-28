@extends('layout.master')

@push('css')
    <style>
        .health-form {
            border: 1px solid #ccc;
            border-radius: 15px;
            box-shadow: 0 0 30px #838383c6;
            background-color: #ffffffcc;
            height: 80vh;
            overflow: auto;
        }

        .health-form::-webkit-scrollbar {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center align-content-center">
            <div class="col-lg-6 col-sx-8 col-11 health-form">

                <div class="d-flex justify-content-between align-items-center p-3">
                    <h1>Records</h1>

                    <a href="{{ route('health-records.reports') }}" class="btn btn-outline-dark">查看紀錄</a>
                </div>

                @if (!is_null($success ?? null))
                <div class="p-3 alert-info">

                    {{ $success }}

                </div>
                @endif

                <div class="px-3 py-5">
                    <form action="{{ route('health-records.update') }}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="{{ $healthRecordsInfo['id'] }}">
                        <div class="mb-3">
                            <label for="health-date" class="form-label"><span class="text-danger">*</span>日期</label>
                            <input type="date" class="form-control" name="health-date" id="health-date" placeholder="日期"
                                aria-describedby="" value="{{ \Carbon\Carbon::parse($healthRecordsInfo['health-date'])->format("Y-m-d") }}" required>
                            {{-- <div id="" class="form-text"></div> --}}
                        </div>
                        <div class="mb-3">
                            <label for="health-breakfast" class="form-label"><span class="text-danger">*</span>早餐</label>
                            <input type="text" class="form-control mb-2" name="health-breakfast" id="health-breakfast"
                                placeholder="早餐" value="{{ $healthRecordsInfo['health-breakfast'] }}" required>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="health-breakfast-img"
                                    id="health-breakfast-img" accept="image/*">
                                <label class="input-group-text" for="health-breakfast-img">Upload</label>
                            </div>
                            <img src="{{ url('uploads/' . $healthRecordsInfo['health-breakfast-img']) }}" id="health-breakfast-img-display" class="img-thumbnail" width="300" alt="">
                        </div>
                        <div class="mb-3">
                            <label for="health-lunch" class="form-label"><span class="text-danger">*</span>午餐</label>
                            <input type="text" class="form-control mb-2" name="health-lunch" id="health-lunch"
                                placeholder="午餐" value="{{ $healthRecordsInfo['health-lunch'] }}" required>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="health-lunch-img" id="health-lunch-img"
                                    accept="image/*">
                                <label class="input-group-text" for="health-lunch-img">Upload</label>
                            </div>
                            <img src="{{ url('uploads/' . $healthRecordsInfo['health-lunch-img']) }}" id="health-lunch-img-display" width="300" class="img-thumbnail" alt="">
                        </div>
                        <div class="mb-3">
                            <label for="health-dinner" class="form-label"><span class="text-danger">*</span>晚餐</label>
                            <input type="text" class="form-control mb-2" name="health-dinner" id="health-dinner"
                                placeholder="晚餐" value="{{ $healthRecordsInfo['health-dinner'] }}" required>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="health-dinner-img" id="health-dinner-img"
                                    accept="image/*">
                                <label class="input-group-text" for="health-dinner-img">Upload</label>
                            </div>
                            <img src="{{ url('uploads/' . $healthRecordsInfo['health-dinner-img']) }}" id="health-dinner-img-display" width="300" class="img-thumbnail" alt="">
                        </div>
                        <div class="mb-3">
                            <label for="health-bedtime-snacks" class="form-label"><span
                                    class="text-danger">*</span>宵夜</label>
                            <input type="text" class="form-control mb-2" name="health-bedtime-snacks"
                                id="health-bedtime-snacks" placeholder="宵夜" value="{{ $healthRecordsInfo['health-bedtime-snacks'] }}" required>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="health-bedtime-snacks-img" id="health-bedtime-snacks-img"
                                    accept="image/*">
                                <label class="input-group-text" for="health-bedtime-snacks-img">Upload</label>
                            </div>
                            <img src="{{ url('uploads/' . $healthRecordsInfo['health-bedtime-snacks-img']) }}" id="health-bedtime-snacks-img-display" class="img-thumbnail" width="300" alt="">
                        </div>
                        <div class="mb-3">
                            <label for="health-snacks" class="form-label"><span class="text-danger">*</span>零食</label>
                            <input type="text" class="form-control" name="health-snacks" id="health-snacks"
                                placeholder="零食" value="{{ $healthRecordsInfo['health-snacks'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="health-drinks" class="form-label"><span class="text-danger">*</span>飲料</label>
                            <input type="text" class="form-control" name="health-drinks" id="health-drinks"
                                placeholder="飲料" value="{{ $healthRecordsInfo['health-drinks'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="health-water" class="form-label"><span class="text-danger">*</span>喝水量</label>
                            <input type="number" min="0" class="form-control" name="health-water"
                                id="health-water" placeholder="喝水量" value="{{ $healthRecordsInfo['health-water'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="health-sports" class="form-label"><span class="text-danger">*</span>有無運動</label>
                            <select class="form-control" id="health-sports" name="health-sports" required>
                                <option value="" disabled>請選擇</option>
                                <option value="有" {{ $healthRecordsInfo['health-sports'] == '有' ? 'selected' : '' }}>有</option>
                                <option value="無" {{ $healthRecordsInfo['health-sports'] == '無' ? 'selected' : '' }}>無</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="health-defecation-count" class="form-label"><span
                                    class="text-danger">*</span>排便次數</label>
                            <input type="number" min="0" class="form-control" name="health-defecation-count"
                                id="health-defecation-count" placeholder="排便次數" value="{{ $healthRecordsInfo['health-defecation-count'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="health-getup-time" class="form-label"><span
                                    class="text-danger">*</span>起床時間</label>
                            <input type="time" class="form-control" name="health-getup-time" id="health-get-up-time"
                                placeholder="起床時間" value="{{ $healthRecordsInfo['health-getup-time'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="health-sleep-time" class="form-label"><span
                                    class="text-danger">*</span>睡眠時間</label>
                            <input type="time" class="form-control" name="health-sleep-time" id="health-sleep-time"
                                placeholder="睡眠時間" value="{{ $healthRecordsInfo['health-sleep-time'] }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="health-mood-sharing" class="form-label"><span
                                    class="text-danger d-none">*</span>心情分享</label>
                            <textarea class="form-control" name="health-mood-sharing" id="health-mood-sharing" placeholder="心情分享"
                                cols="30" rows="5">{{ $healthRecordsInfo['health-mood-sharing'] }}</textarea>
                        </div>
                        @csrf

                        {{-- <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-outline-primary ml-auto">送出紀錄</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('js')

    <script>
        $(function() {
            $('#health-breakfast-img').on('change', function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#health-breakfast-img-display').prop('src', e.target.result);
                    $('#health-breakfast-img-display').show();
                }
                reader.readAsDataURL(this.files[0]);
            })
            $('#health-lunch-img').on('change', function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#health-lunch-img-display').prop('src', e.target.result);
                    $('#health-lunch-img-display').show();
                }
                reader.readAsDataURL(this.files[0]);
            })
            $('#health-dinner-img').on('change', function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#health-dinner-img-display').prop('src', e.target.result);
                    $('#health-dinner-img-display').show();
                }
                reader.readAsDataURL(this.files[0]);
            })
            $('#health-bedtime-snacks-img').on('change', function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#health-bedtime-snacks-img-display').prop('src', e.target.result);
                    $('#health-bedtime-snacks-img-display').show();
                }
                reader.readAsDataURL(this.files[0]);
            })
        })
    </script>
@endpush
