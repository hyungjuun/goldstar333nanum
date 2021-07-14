@extends('layouts.nwwifiv1')

@section('title', __('나눔 장비등록현황'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>등록 리스트 </h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">장비 등록 현황을 관리합니다.</h3>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <p><b>* AP 상태 :</b> <b>서비스 변경일</b> 기준으로 2일동안 표기 됩니다. <b>회수 및 변경시 </b> 2일 이내에 변경절차를 진행해 주시기 바랍니다.</p>
                        </div>
                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">

                                    @if(Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif

                                    @if(Session::get('fail'))
                                        <div class="alert alert-danget">
                                            {{ Session::get('fail') }}
                                        </div>
                                    @endif

                                    <div class="col-sm-12 ">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="AP 리스트" width="100%">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 200px;"  aria-label="상점정보: activate to sort column ascending">설치장소</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 70px;" aria-label="AP명: activate to sort column ascending">AP명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="MAC정보: activate to sort column ascending">MAC</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="MAC정보: activate to sort column ascending">Serial No</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 68px;" aria-label="모델명: activate to sort column ascending">모델명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 61px;" aria-label="제조사: activate to sort column ascending">제조사</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="MAC정보: activate to sort column ascending">AP 코드</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 167px;" aria-sort="descending" aria-label="등록일: activate to sort column ascending">등록일</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 167px;" aria-sort="descending" aria-label="작업자: activate to sort column ascending">설치자</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 50px;" aria-label="AP상태: activate to sort column ascending">AP상태</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($list as $item)
                                                <tr data-target="#modal-lg"  role="row" class="odd" >
                                                    <td>
                                                        <b style="color: #0c84ff;">{{ $item->STORE_NAME }}</b><br/>
                                                        {{ $item->POSTCODE }}<br/>
                                                        {{ $item->ADDRESS1 }}<br/>
                                                        {{ $item->ADDRESS2 }}<br/>
                                                    </td>
                                                    <td onclick="location.href='{{ url('newapmgtreadyedit') }}/{{$item->SEQ}}'">{{ $item->AP_NM }}</td>
                                                    <td onclick="location.href='{{ url('newapmgtreadyedit') }}/{{$item->SEQ}}'">{{ $item->AP_MAC }}</td>
                                                    <td onclick="location.href='{{ url('newapmgtreadyedit') }}/{{$item->SEQ}}'">{{ $item->SERIAL_NO }}</td>
                                                    <td onclick="location.href='{{ url('newapmgtreadyedit') }}/{{$item->SEQ}}'">{{ $item->AP_MODEL }}</td>
                                                    <td onclick="location.href='{{ url('newapmgtreadyedit') }}/{{$item->SEQ}}'">{{ $item->AP_FAC }}</td>
                                                    <td onclick="location.href='{{ url('newapmgtreadyedit') }}/{{$item->SEQ}}'">{{ $item->AP_CD }}</td>

                                                    <td onclick="location.href='{{ url('newapmgtreadyedit') }}/{{$item->SEQ}}'">{{ $item->REG_DT }}</td>
                                                    <td onclick="location.href='{{ url('newapmgtreadyedit') }}/{{$item->SEQ}}'">{{ $item->WORKER1 }}</td>
                                                    <td onclick="location.href='{{ url('newapmgtreadyedit') }}/{{$item->SEQ}}'">
                                                        @if($item->AP_STS == 0) <span class="label label-default">대기</span> @endif
                                                        @if($item->AP_STS == 3) <span class="label label-primary">등록</span> @endif
                                                        @if($item->AP_STS == 1) <span class="label label-success">서비스</span> @endif
                                                        @if($item->AP_STS == 2) <span class="label label-danger">고장</span> @endif
                                                        @if($item->AP_STS == 4) <span class="label label-warning">회수</span> @endif
                                                        @if($item->AP_STS == 5) <span class="label label-danger">파손</span> @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">설치장소</th>
                                                <th rowspan="1" colspan="1">AP명</th>
                                                <th rowspan="1" colspan="1">MAC</th>
                                                <th rowspan="1" colspan="1">Serial No</th>
                                                <th rowspan="1" colspan="1">모델명</th>
                                                <th rowspan="1" colspan="1">제조사</th>
                                                <th rowspan="1" colspan="1">AP 코드</th>
                                                <th rowspan="1" colspan="1">등록일</th>
                                                <th rowspan="1" colspan="1">설치자</th>
                                                <th rowspan="1" colspan="1">AP상태</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable(
                {
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
                    "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]]
                }
            );
        } );
    </script>

@endsection
