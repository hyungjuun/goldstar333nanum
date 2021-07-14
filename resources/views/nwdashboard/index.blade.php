@extends('layouts.nwwifiv1')

@section('title', __('서비스 현황'))

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="h1-border">서비스 현황 </h1>
            </div>
        </div>

        <div class="row" >
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><span style="color: #856a19;">승인대기 상점수 : {{ $dashnewuser[0]->newcnt }}</span></h3>

                        <p>미 승인 가맹점 수(최근 3일기준)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="/nwpromlist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6" style="display: none; " >
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>150</h3>

                        <p>전체 상점수</p>
                    </div>
                    <div class="icon">
                        <ion-icon name="storefront-outline"></ion-icon>
                        <i class="ion ion-wifi"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $dashlate[0]->latecnt }}</h3>

                        <p>탈퇴 및 거절 상점수 </p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-trash"></i>
                    </div>
                    <a href="/nwpromlist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6" style="display: none;">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">플랫폼 지표</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>상점수</th>
                                <th>신규AP</th>
                                <th >활성AP</th>
                                <th >장애AP</th>
                                <th >전체AP</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$apstorecnt[0]->apstorecnt_tot}}</td>
                                <td>{{$todayapcnt[0]->todayapcnt_tot}}</td>
                                <td>{{$useapcnt[0]->useapcnt_tot}}</td>
                                <td>{{$failapcnt[0]->failapcnt_tot}}</td>
                                <td>{{$aptotalcnt[0]->aptotalcnt_tot}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card card-primary card-outline">

                        <div class="card-header">
                            <h3 class="card-title">서비스 개요</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>전체접속자</th>
                                    <th>오늘접속자수</th>
                                    <th>신규가입자수</th>
                                    <th>가입자수</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $totalconn[0]->totalconn_tot }}</td>
                                    <td>{{ $nowconn[0]->nowconn_tot }}</td>
                                    <td>{{ $todayapply[0]->todayapply_tot }}</td>
                                    <td>{{$totaluser[0]->totaluser_tot}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">상위 상점정보</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th style="width: 10px">No</th>
                                <th>상점명   </th>
                                <th style="width: 100px" class="hidden-xs"><span class="dash-data-level">{{ date('Y-m-d', strtotime('-4 day')) }}</span></th>
                                <th style="width: 100px" class="hidden-xs"><span class="dash-data-level">{{ date('Y-m-d', strtotime('-3 day')) }}</span></th>
                                <th style="width: 100px" class="hidden-xs"><span class="dash-data-level">{{ date('Y-m-d', strtotime('-2 day')) }}</span></th>
                                <th style="width: 100px" class="hidden-xs"><span class="dash-data-level">{{ date('Y-m-d', strtotime('-1 day')) }}</span></th>
                                <th style="width: 110px">오늘접속자</th>
                                <th style="width: 110px">전체접속자</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($storeinfo as $Sinfo )
                                <tr>
                                    <td>{{ $infonum++ }}</td>
                                    <td>{{ $Sinfo->STORE_NAME }}</td>
                                    <td class="hidden-xs dash-data-level-align"><span class="badge bg-primary  ">{{ $Sinfo->fourday }}</span></td>
                                    <td class="hidden-xs dash-data-level-align"><span class="badge bg-primary  ">{{ $Sinfo->threeday }}</span></td>
                                    <td class="hidden-xs dash-data-level-align"><span class="badge bg-primary  ">{{ $Sinfo->twoday }}</span></td>
                                    <td class="hidden-xs dash-data-level-align"><span class="badge bg-primary  ">{{ $Sinfo->oneday }}</span></td>
                                    <td class="dash-data-level-align" ><span class="badge bg-primary  ">{{ $Sinfo->today }}</span></td>
                                    <td class="dash-data-level-align" ><span class="badge bg-danger  ">{{ $Sinfo->total }}</span></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">AP 네트워크 상태</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">보유 장비 현황</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <canvas id="donutChart1" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">AP To 상점 연동 상태그래프</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <canvas id="stackedBarChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .small-box>.small-box-footer {
            background-color: rgba(0,0,0,.1);
            color: rgba(255,255,255,.8);
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }


        .small-box {
            border-radius: .25rem;
            box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);
            display: block;
            margin-bottom: 20px;
            position: relative;
        }
        .small-box>.inner { padding: 10px; }
        .small-box .icon>i {
            font-size: 90px;
            position: absolute;
            right: 15px;
            top: 15px;
            transition: -webkit-transform .3s linear;
            transition: transform .3s linear;
            transition: transform .3s linear,-webkit-transform .3s linear;
        }
        .small-box .icon { color: rgba(0,0,0,.15); z-index: 0;}
        .small-box .icon>i.fa, .small-box .icon>i.fab, .small-box .icon>i.fad, .small-box .icon>i.fal, .small-box .icon>i.far, .small-box .icon>i.fas, .small-box .icon>i.ion {
            font-size: 70px;
            top: 20px;
        }
        .bg-warning {
            background-color: #ffc107!important;
        }
    </style>
@endpush

@section('scripts')
    <script>
        $(function () {

            var donutChartCanvas1 = $('#donutChart1').get(0).getContext('2d');
            var donutData1 = {
                labels: [
                    '대기({{$realapcnt[0]->astep}})',
                    '서비스({{$realapcnt[0]->bstep}})',
                    '고장({{$realapcnt[0]->cstep}})',
                    '등록({{$realapcnt[0]->dstep}})',
                    '회수({{$realapcnt[0]->estep}})',
                    '파손({{$realapcnt[0]->fstep}})',
                ],
                datasets: [
                    {
                        data: [{{$realapcnt[0]->astep}},{{$realapcnt[0]->bstep}},{{$realapcnt[0]->cstep}},{{$realapcnt[0]->dstep}},{{$realapcnt[0]->estep}},{{$realapcnt[0]->fstep}}],
                        backgroundColor : ['#777', '#5cb85c', '#f56954', '#337ab7', '#f39c12', '#c23434'],
                    }
                ]
            };
            var donutOptions1     = {
                maintainAspectRatio : false,
                responsive : true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart1 = new Chart(donutChartCanvas1, {
                type: 'doughnut',
                data: donutData1,
                options: donutOptions1
            });

            var areaChartData = {
                labels  : [
                    @foreach($apstatus as $statusval)
                        '{{$statusval->thedate}}',
                    @endforeach
                ],
                datasets: [
                    {
                        label               : '대기',
                        backgroundColor     : 'rgba(27,148,54,0.9)',
                        borderColor         : 'rgba(27,148,54,0.8)',
                        pointRadius          : false,
                        pointColor          : '#00a65a',
                        pointStrokeColor    : 'rgba(27,148,54,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(27,148,54,1)',
                        data                : [
                            @foreach($apstatus as $statusval)
                            {{$statusval->cnt1}},
                            @endforeach
                        ]
                    },
                    {
                        label               : '서비스',
                        backgroundColor     : 'rgba(27,148,54,0.9)',
                        borderColor         : 'rgba(27,148,54,0.8)',
                        pointRadius          : false,
                        pointColor          : '#00a65a',
                        pointStrokeColor    : 'rgba(27,148,54,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(27,148,54,1)',
                        data                : [
                            @foreach($apstatus as $statusval)
                            {{$statusval->cnt1}},
                            @endforeach
                        ]
                    },
                    {
                        label               : '고장',
                        backgroundColor     : 'rgba(27,148,54,0.9)',
                        borderColor         : 'rgba(27,148,54,0.8)',
                        pointRadius          : false,
                        pointColor          : '#00a65a',
                        pointStrokeColor    : 'rgba(27,148,54,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(27,148,54,1)',
                        data                : [
                            @foreach($apstatus as $statusval)
                            {{$statusval->cnt1}},
                            @endforeach
                        ]
                    },
                    {
                        label               : '등록',
                        backgroundColor     : 'rgba(27,148,54,0.9)',
                        borderColor         : 'rgba(27,148,54,0.8)',
                        pointRadius          : false,
                        pointColor          : '#00a65a',
                        pointStrokeColor    : 'rgba(27,148,54,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(27,148,54,1)',
                        data                : [
                            @foreach($apstatus as $statusval)
                            {{$statusval->cnt1}},
                            @endforeach
                        ]
                    },
                    {
                        label               : '회수',
                        backgroundColor     : 'rgba(244, 0, 0, 1)',
                        borderColor         : 'rgba(244, 0, 0, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(244, 0, 0, 1)',
                        pointStrokeColor    : '#f56954',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [
                            @foreach($apstatus as $statusval)
                            {{$statusval->cnt2}},
                            @endforeach
                        ]
                    },
                    {
                        label               : '파손',
                        backgroundColor     : 'rgba(244, 0, 0, 1)',
                        borderColor         : 'rgba(244, 0, 0, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(244, 0, 0, 1)',
                        pointStrokeColor    : '#f56954',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [
                            @foreach($apstatus as $statusval)
                            {{$statusval->cnt2}},
                            @endforeach
                        ]
                    },
                ]
            };



            var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
            var donutData = {
                labels: [
                    '정상({{$realcnt[0]->ok}})',
                    '장애({{$realcnt[0]->err}})',
                ],
                datasets: [
                    {
                        data: [{{$realcnt[0]->ok}},{{$realcnt[0]->err}}],
                        backgroundColor : ['#00a65a', '#f56954'],
                    }
                ]
            };
            var donutOptions     = {
                maintainAspectRatio : false,
                responsive : true,
            };
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            });

            var areaChartData = {
                labels  : [
                @foreach($apstatus as $statusval)
                    '{{$statusval->thedate}}',
                @endforeach
            ],
                datasets: [
                    {
                        label               : '정상',
                        backgroundColor     : 'rgba(27,148,54,0.9)',
                        borderColor         : 'rgba(27,148,54,0.8)',
                        pointRadius          : false,
                        pointColor          : '#00a65a',
                        pointStrokeColor    : 'rgba(27,148,54,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(27,148,54,1)',
                        data                : [
                            @foreach($apstatus as $statusval)
                            {{$statusval->cnt1}},
                            @endforeach
                        ]
                    },
                    {
                        label               : '장애',
                        backgroundColor     : 'rgba(244, 0, 0, 1)',
                        borderColor         : 'rgba(244, 0, 0, 1)',
                        pointRadius         : false,
                        pointColor          : 'rgba(244, 0, 0, 1)',
                        pointStrokeColor    : '#f56954',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data                : [
                            @foreach($apstatus as $statusval)
                            {{$statusval->cnt2}},
                            @endforeach
                        ]
                    },
                ]
            };

            //-------------
            //- BAR CHART -
            //-------------
            var barChartData = jQuery.extend(true, {}, areaChartData);
            var temp0 = areaChartData.datasets[0];
            var temp1 = areaChartData.datasets[1];
            barChartData.datasets[0] = temp1;
            barChartData.datasets[1] = temp0;

            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d');
            var stackedBarChartData = jQuery.extend(true, {}, barChartData);

            var stackedBarChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }

            var stackedBarChart = new Chart(stackedBarChartCanvas, {
                type: 'bar',
                data: stackedBarChartData,
                options: stackedBarChartOptions
            })

        });
    </script>
@endsection
