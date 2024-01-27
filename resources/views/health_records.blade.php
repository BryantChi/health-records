@extends('layout.master')

@push('css')
    <style>
        .health-table {
            border: 1px solid #ccc;
            border-radius: 15px;
            box-shadow: 0 0 30px #838383c6;
            background: #ffffffcc;
            height: 80vh;
            overflow: auto;
        }
        .health-table::-webkit-scrollbar {
            display: none;
        }
        .table {
            display: table;
            text-align: center;
            width: 100%;
            margin: 0% auto 0;
            border-collapse: separate;
            font-family: "Roboto", sans-serif;
            font-weight: 400;
        }

        .table_row {
            display: table-row;
        }

        .theader {
            display: table-row;
        }

        .table_header {
            display: table-cell;
            border-bottom: #ccc 1px solid;
            border-top: #ccc 1px solid;
            background: #bdbdbd;
            color: #474747;
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: 700;
            word-break: keep-all;
        }

        .table_header:first-child {
            border-left: #ccc 1px solid;
            border-top-left-radius: 5px;
        }

        .table_header:last-child {
            border-right: #ccc 1px solid;
            border-top-right-radius: 5px;
        }

        .table_small {
            display: table-cell;
        }

        .table_row>.table_small>.table_cell:nth-child(odd) {
            display: none;
            background: #bdbdbd;
            /* color: #e5e5e5; */
            color: #474747;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .table_row>.table_small>.table_cell {
            padding-top: 3px;
            padding-bottom: 3px;
            color: #5b5b5b;
            /* border-bottom: #ccc 1px solid; */
        }

        .table_row>.table_small:first-child>.table_cell {
            /* border-left: #ccc 1px solid; */
        }

        .table_row>.table_small:last-child>.table_cell {
            /* border-right: #ccc 1px solid; */
        }

        .table_row:last-child>.table_small:last-child>.table_cell:last-child {
            border-bottom-right-radius: 5px;
        }

        .table_row:last-child>.table_small:first-child>.table_cell:last-child {
            border-bottom-left-radius: 5px;
        }

        .table_row:nth-child(2n + 3) {
            background: #e9e9e9;
        }

        @media screen and (max-width: 900px) {
            .table {
                width: 90%;
            }
        }

        @media screen and (max-width: 650px) {
            .table {
                display: block;
            }

            .table_row:nth-child(2n + 3) {
                background: none;
            }

            .theader {
                display: none;
            }

            .table_row>.table_small>.table_cell:nth-child(odd) {
                display: table-cell;
                width: 50%;
            }

            .table_cell {
                display: table-cell;
                width: 50%;
            }

            .table_row {
                display: table;
                width: 100%;
                border-collapse: separate;
                padding-bottom: 20px;
                margin: 5% auto 0;
                text-align: center;
            }

            .table_small {
                display: table-row;
            }

            .table_row>.table_small:first-child>.table_cell:last-child {
                border-left: none;
            }

            .table_row>.table_small>.table_cell:first-child {
                /* border-left: #ccc 1px solid; */
            }

            .table_row>.table_small:first-child>.table_cell:first-child {
                border-top-left-radius: 5px;
                /* border-top: #ccc 1px solid; */
            }

            .table_row>.table_small:first-child>.table_cell:last-child {
                border-top-right-radius: 5px;
                /* border-top: #ccc 1px solid; */
            }

            .table_row>.table_small:last-child>.table_cell:first-child {
                border-right: none;
            }

            .table_row>.table_small>.table_cell:last-child {
                /* border-right: #ccc 1px solid; */
            }

            .table_row>.table_small:last-child>.table_cell:first-child {
                border-bottom-left-radius: 5px;
            }

            .table_row>.table_small:last-child>.table_cell:last-child {
                border-bottom-right-radius: 5px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center align-content-center">
            <div class="col-md-12 col-11 rounded health-table position-relative">
                <div class="d-flex justify-content-between align-items-center p-3 fixed">
                    <h1>Reports</h1>

                    <a href="{{ route('index') }}" class="btn btn-outline-dark">開始紀錄</a>
                </div>

                <div class="table overflow-auto p-2 mb-5" id="results"  style="background: #ffffffcc">
                    <div class='theader'>
                        <div class='table_header'>日期</div>
                        <div class='table_header'>早餐</div>
                        <div class='table_header'>早餐照</div>
                        <div class='table_header'>午餐</div>
                        <div class='table_header'>午餐照</div>
                        <div class='table_header'>晚餐</div>
                        <div class='table_header'>晚餐照</div>
                        <div class='table_header'>宵夜</div>
                        <div class='table_header'>宵夜照</div>
                        <div class='table_header'>零食</div>
                        <div class='table_header'>飲料</div>
                        <div class='table_header'>喝水量</div>
                        <div class='table_header'>有無運動</div>
                        <div class='table_header'>排便次數</div>
                        <div class='table_header'>起床時間</div>
                        <div class='table_header'>睡眠時間</div>
                        <div class='table_header'>心情分享</div>
                    </div>
                    @foreach ($healthRecordsInfo as $item)
                        <div class='table_row'>
                            <div class='table_small'>
                                <div class='table_cell'>日期</div>
                                <div class='table_cell'>{{ $item['health-date'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>早餐</div>
                                <div class='table_cell'>{{ $item['health-breakfast'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>早餐照</div>
                                <div class='table_cell'>
                                    <a href="{{ asset('uploads/' . $item['health-breakfast-img']) }}" data-fancybox>
                                        <img src="{{ asset('uploads/' . $item['health-breakfast-img']) }}"
                                        class="img-fluid" style="width: 200px !important;" alt="">
                                    </a>

                                </div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>午餐</div>
                                <div class='table_cell'>{{ $item['health-lunch'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>午餐照</div>
                                <div class='table_cell'>
                                    <a href="{{ asset('uploads/' . $item['health-lunch-img']) }}" data-fancybox>
                                        <img src="{{ asset('uploads/' . $item['health-lunch-img']) }}"
                                        class="img-fluid" style="width: 200px;" alt="">
                                    </a>

                                </div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>晚餐</div>
                                <div class='table_cell'>{{ $item['health-dinner'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>晚餐照</div>
                                <div class='table_cell'>
                                    <a href="{{ asset('uploads/' . $item['health-dinner-img']) }}" data-fancybox>
                                        <img src="{{ asset('uploads/' . $item['health-dinner-img']) }}"
                                        class="img-fluid" style="width: 200px;" alt="">
                                    </a>

                                </div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>宵夜</div>
                                <div class='table_cell'>{{ $item['health-bedtime-snacks'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>宵夜照</div>
                                <div class='table_cell'>
                                    <a href="{{ asset('uploads/' . $item['health-bedtime-snacks-img']) }}" data-fancybox>
                                        <img src="{{ asset('uploads/' . $item['health-bedtime-snacks-img']) }}"
                                        class="img-fluid" style="width: 200px;" alt="">
                                    </a>

                                </div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>零食</div>
                                <div class='table_cell'>{{ $item['health-snacks'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>飲料</div>
                                <div class='table_cell'>{{ $item['health-drinks'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>喝水量</div>
                                <div class='table_cell'>{{ $item['health-water'] }} cc</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>有無運動</div>
                                <div class='table_cell'>{{ $item['health-sports'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>排便次數</div>
                                <div class='table_cell'>{{ $item['health-defecation-count'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>起床時間</div>
                                <div class='table_cell'>{{ $item['health-getup-time'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>睡眠時間</div>
                                <div class='table_cell'>{{ $item['health-sleep-time'] }}</div>
                            </div>
                            <div class='table_small'>
                                <div class='table_cell'>睡眠時間</div>
                                <div class='table_cell'>{{ $item['health-mood-sharing'] }}</div>
                            </div>
                        </div>
                    @endforeach

                </div>
                {{ $healthRecordsInfo->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
@endsection
