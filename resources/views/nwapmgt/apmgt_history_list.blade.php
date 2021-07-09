@extends('layouts.nwwifiv1')

@section('title', __('나눔 장비등록현황'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>장비등록현황 </h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">장비등록현황을 관리합니다.</h3>
                            <form role="form" id="quickForm" method="post" action="#" novalidate="novalidate">
                                @csrf
                                <input type="hidden" name="stdate" id="stdate" value="" />
                                <input type="hidden" name="endate" id="endate" value="" />

                                <div class=" float-sm-left col-sm-12"  style="margin-top: 2rem; ">

                                    <div class="form-group col-sm-2">
                                        <label for="startDate">startDate</label>
                                        <input type="text" class="form-control" id="startDate" name="startDate" value="{{$datapic_start}}">
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <label for="endDate">endDate</label>
                                        <input type="text" class="form-control" id="endDate" name="endDate" value="{{$datapic_end}}">
                                    </div>

                                    <div class="form-group col-sm-2">
                                        <label>AP STATE:</label>
                                        <select name="ap_sts" class="form-control">
                                            <option value="4">기간제외전체</option>
                                            <option value="3">기간설정전체</option>
                                            <option value="0">등록</option>
                                            <option value="1">서비스</option>
                                            <option value="2">삭제</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-2">
                                        <button type="button" class="btn btn-primary " style="margin-top: 2.3rem;" onclick="formclick()" ><i class="fas fa-save"></i> Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="AP 리스트" width="100%;">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="AP명: activate to sort column ascending">AP명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 110px;" aria-label="MAC정보: activate to sort column ascending">MAC</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 110px;" aria-label="MAC정보: activate to sort column ascending">Serial No</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="MAC정보: activate to sort column ascending">AP 코드</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 96px;" aria-label="IP: activate to sort column ascending">IP</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 60px;" aria-label="AP현재상태: activate to sort column ascending">AP상태정보</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 60px;" aria-label="네트워크상태: activate to sort column ascending">네트워크상태</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 60px;" aria-label="모델명: activate to sort column ascending">모델명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 60px;" aria-label="제조사: activate to sort column ascending">제조사</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-sort="descending" aria-label="등록일: activate to sort column ascending">변경일</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 80px;" aria-sort="descending" aria-label="작업자: activate to sort column ascending">작업자</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 80px;" aria-label="상태: activate to sort column ascending">상태</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 60px;" aria-label="설치상점: activate to sort column ascending">PK</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="200px;" aria-label="설치주소: activate to sort column ascending">설치주소</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($list as $item)
                                                <tr data-toggle="modal" data-target="#modal-lg"  role="row" class="odd">

                                                    <td>{{ $item->AP_NM }}</td>
                                                    <td>{{ $item->AP_MAC }}</td>
                                                    <td>{{ $item->SERIAL_NO }}</td>
                                                    <td>{{ $item->AP_CD }}</td>
                                                    <td>{{ $item->AP_IP }}</td>
                                                    <td>
                                                        @if(empty($item->ADM_STS))
                                                            -
                                                        @else
                                                            @if($item->ADM_STS == 0) 등록 @endif
                                                            @if($item->ADM_STS == 1) 서비스 @endif
                                                            @if($item->ADM_STS == 2) 중지 @endif
                                                            @if($item->ADM_STS == '') 미등록 @endif
                                                            <br/>
                                                            @if($item->ADM_STS == 2)
                                                                [
                                                                @if($item->AP_STS_REASON == 1) 분실 @endif
                                                                @if($item->AP_STS_REASON == 2) 고장 @endif
                                                                @if($item->AP_STS_REASON == 3) 파손 @endif
                                                                @if($item->AP_STS_REASON == 4) 회수 @endif
                                                                @if($item->AP_STS_REASON == 5) 종료 @endif
                                                                ]
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if($item->AP_STS == 0) 등록 @endif
                                                        @if($item->AP_STS == 1) 서비스 @endif
                                                        @if($item->AP_STS == 2) 중지 @endif
                                                    </td>
                                                    <td>{{ $item->AP_MODEL }}</td>
                                                    <td>{{ $item->AP_FAC }}</td>
                                                    <td>{{ $item->REG_DT }}</td>
                                                    <td>{{ $item->UPD_ID }}</td>
                                                    <td>{{ $item->COMMENT }}</td>
                                                    <td>{{ $item->PARENT_KEY }}</td>
                                                    <td>{{ $item->ADDR1 }}</td>

                                                </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">AP명</th>
                                                <th rowspan="1" colspan="1">MAC</th>
                                                <th rowspan="1" colspan="1">Serial No</th>
                                                <th rowspan="1" colspan="1">AP 코드</th>
                                                <th rowspan="1" colspan="1">IP</th>
                                                <th rowspan="1" colspan="1">AP상태정보</th>
                                                <th rowspan="1" colspan="1">네트워크상태</th>
                                                <th rowspan="1" colspan="1">모델명</th>
                                                <th rowspan="1" colspan="1">제조사</th>
                                                <th rowspan="1" colspan="1">변경일</th>
                                                <th rowspan="1" colspan="1">작업자</th>
                                                <th rowspan="1" colspan="1">상태</th>
                                                <th rowspan="1" colspan="1">PK</th>
                                                <th rowspan="1" colspan="1">설치주소</th>
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
        function formclick(){

            var startDate = $('#stdate').val();
            var endDate = $('#endate').val();

            if(startDate == ""){
                var tmp_start = $('#startDate').val();
                var tmp_start_arr = tmp_start.split('/');
                var tmp_start_new = tmp_start_arr[2]+"-"+tmp_start_arr[0]+"-"+tmp_start_arr[1];
                $('#stdate').val(tmp_start_new);
            }

            if(endDate == ""){
                var tmp_end = $('#startDate').val();
                var tmp_end_arr = tmp_end.split('/');
                var tmp_endt_new = tmp_end_arr[2]+"-"+tmp_end_arr[0]+"-"+tmp_end_arr[1];
                $('#endate').val(tmp_endt_new);
            }


            var startArray = startDate.split('-');
            var endArray = endDate.split('-');

            var start_date = new Date(startArray[0], startArray[1], startArray[2]);
            var end_date = new Date(endArray[0], endArray[1], endArray[2]);

            if(start_date.getTime() > end_date.getTime()) {
                alert("종료날짜보다 시작날짜가 작아야합니다.");
                return false;
            }

            $('#quickForm')[0].action="/nwaphistorylist";
            $('#quickForm')[0].submit();
        }

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
                    "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]]
                }
            );

            $('input[name="startDate"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
            }, function(start, end, label) {
                $("#stdate").val(start.format('YYYY-MM-DD'));
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });

            $('input[name="endDate"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true
            }, function(start, end, label) {
                $("#endate").val(end.format('YYYY-MM-DD'));
                console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
            });
        } );

    </script>


@endsection
