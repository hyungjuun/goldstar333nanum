@extends('layouts.nwwifiv1')

@section('title', __('나눔 고객정보 관리'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>AP 위치보기 </h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">AP가 설치된 장소입니다.</h3>
                            <div class=" float-sm-right"> </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="map" style="width:100%;height:620px;"><img src="/resources/dist/img/map.png" width="100%" height="100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>

@endsection

@section('scripts')

@endsection
