@extends('layouts.nwwifiv1')

@section('title', __('나눔 장비등록 서비스 현황'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>서비스 리스트 </h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">서비스 현황을 관리합니다.</h3>

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

                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="AP 리스트" width="100%">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="IP: activate to sort column ascending">IP</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 120px;" aria-label="MAC정보: activate to sort column ascending">MAC</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="MAC정보: activate to sort column ascending">Serial No</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 60px;" aria-label="모델명: activate to sort column ascending">모델명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 61px;" aria-label="제조사: activate to sort column ascending">제조사</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="MAC정보: activate to sort column ascending">AP 코드</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-label="상점정보: activate to sort column ascending">설치장소</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-label="상점명: activate to sort column ascending">상점명</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 80px;" aria-sort="descending" aria-label="등록일: activate to sort column ascending">등록일</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 50px;" aria-sort="descending" aria-label="작업자: activate to sort column ascending">설치자</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 50px;" aria-label="AP상태: activate to sort column ascending">AP상태</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($list as $item)
                                                <tr data-target="#modal-lg"  role="row" class="odd" onclick="location.href='{{ url('newapmgtserviceedit') }}/{{$item->SEQ}}'" >
                                                    <td>{{ $item->AP_IP }}</td>
                                                    <td>{{ $item->AP_MAC }}</td>
                                                    <td>{{ $item->SERIAL_NO }}</td>
                                                    <td>{{ $item->AP_MODEL }}</td>
                                                    <td>{{ $item->AP_FAC }}</td>
                                                    <td>{{ $item->AP_CD }}</td>
                                                    <td>
                                                        <b style="color: #0c84ff;">{{ $item->STORE_NAME }}</b><br/>
                                                        {{ $item->POSTCODE }}<br/>
                                                        {{ $item->ADDRESS1 }}<br/>
                                                        {{ $item->ADDRESS2 }}<br/>
                                                    </td>
                                                    <td>{{ $item->STORE_NAME }}</td>
                                                    <td>{{ $item->REG_DT }}</td>
                                                    <td>{{ $item->WORKER1 }}</td>
                                                    <td>
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
                                                <th rowspan="1" colspan="1">IP</th>
                                                <th rowspan="1" colspan="1">MAC</th>
                                                <th rowspan="1" colspan="1">Serial No</th>
                                                <th rowspan="1" colspan="1">모델명</th>
                                                <th rowspan="1" colspan="1">제조사</th>
                                                <th rowspan="1" colspan="1">AP 코드</th>
                                                <th rowspan="1" colspan="1">설치장소</th>
                                                <th rowspan="1" colspan="1">상점명</th>
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

    <!-- 등록/수정 폼 -->
    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">AP정보수정</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" id="quickForm" method="post" action="nwapupdate" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="seq" value="10">
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>AP명</label>
                                        <input type="text" name="ap_nm" class="form-control" placeholder="AP명">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>AP CD</label>
                                        <input type="text" name="ap_cd" class="form-control" placeholder="AP CD" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>IP</label>
                                        <input type="text" name="ap_ip" id="ap_ip" class="form-control" placeholder="xxx.xxx.xxx.xxx" >
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>MODEL</label>
                                        <input type="text" name="ap_model" class="form-control" placeholder="MODEL">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>제조사</label>
                                        <input type="text" name="ap_fac" class="form-control" placeholder="제조사">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Serial No</label>
                                        <input type="text" name="ap_serial" class="form-control" placeholder="Serial No" style="text-transform: uppercase;" maxlength="13" >
                                    </div>
                                </div>
                            </div>
                            <div class="row apsts">
                                <div class="col-sm-6 ">
                                    <div class="form-group">
                                        <label>AP 상태변경</label>
                                        <select name="adm_sts" class="form-control">
                                            <option value="">선택</option>
                                            <option value="0">등록</option>
                                            <option value="1">서비스</option>
                                            <option value="2">중지</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6 sts_stop">
                                    <div class="form-group">
                                        <label>중지사유</label>
                                        <select name="ap_sts_reason" class="form-control">
                                            <option value="">선택</option>
                                            <option value="1">분실</option>
                                            <option value="2">고장</option>
                                            <option value="3">파손</option>
                                            <option value="4">회수</option>
                                            <option value="5">종료</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>MAC</label>
                                        <input type="text" name="ap_mac" class="form-control" placeholder="MAC">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <span>
{{--                            <button type="button" class="btn btn-danger delBtn" style=""><i class="far fa-trash-alt"></i> Del</button>--}}
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

        var addForm = function(){
            $('#quickForm')[0].reset();
            $(".modal-title").text("AP등록");
            <?php /* $(".delBtn").hide(); */ ?>
            $(".apsts").hide();
            $('#quickForm')[0].action="/nwapmgtadd";

        };

        $(document).ready(function () {

            $.validator.setDefaults({
                submitHandler: function () {
                    form.submit();
                }
            });

            $('#quickForm').validate({
                rules: {
                    ap_nm: { required: true },
                    ap_serial: { required: true },
                    addr: { required: true },
                    ap_model: { required: true },
                    ap_fac: { required: true }
                },
                messages: {

                    store_id: "Please enter a shop Name",
                    addr: "Please enter a address",
                    ap_ip: "Please enter a ip",
                    ap_model: "Please enter a model",
                    ap_mac: "Please enter a mac"
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });


            $("select[name=adm_sts]").change(function(){

                if($(this).val() == 2){
                    $(".sts_stop").show();
                }else{
                    $(".sts_stop").hide();
                }
            });


        });

    </script>

@endsection
