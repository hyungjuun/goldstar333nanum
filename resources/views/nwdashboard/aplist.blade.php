@extends('layouts.nwwifiv1')

@section('title', __('나눔 AP 코드 관리'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>AP 코드 관리 </h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">AP 코드관리를 관리합니다.</h3>
                        </div>
                        <!-- /.card-header -->
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
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="AP 리스트">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="AP명: activate to sort column ascending">AP명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="MAC정보: activate to sort column ascending">MAC정보</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="Serial No: activate to sort column ascending">Serial No</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 121px;" aria-label="AP 코드: activate to sort column ascending">AP 코드</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 96px;" aria-label="IP: activate to sort column ascending">IP</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 140px;" aria-label="AP상태정보: activate to sort column ascending">네트워크상태정보</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 68px;" aria-label="모델명: activate to sort column ascending">모델명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 61px;" aria-label="제조사: activate to sort column ascending">제조사</th>
                                                <th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 167px;" aria-sort="descending" aria-label="등록일: activate to sort column ascending">등록일</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="상점명/설치주소: activate to sort column ascending">상점명/설치주소</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($list as $item)
                                            <tr data-toggle="modal" data-target="#modal-lg"
                                                onclick="setModify('{{ $item->SEQ }}','{{ $item->AP_CD }}','{{ $item->AP_NM }}','{{ $item->AP_MAC }}','{{ $item->AP_IP }}','{{ $item->STORE_ID }}','{{ $item->AP_MODEL }}','{{ $item->AP_FAC }}','{{ $item->SERIAL_NO }}')" role="row" class="odd">
                                                <td tabindex="0">{{ $item->AP_NM }}</td>
                                                <td>{{ $item->AP_MAC }}</td>
                                                <td>{{ $item->SERIAL_NO }}</td>
                                                <td>{{ $item->AP_CD }}</td>
                                                <td>{{ $item->AP_IP }}</td>
                                                <td>
                                                    @if($item->AP_STS == 0) 등록 @endif
                                                    @if($item->AP_STS == 1) 서비스 @endif
                                                    @if($item->AP_STS == 2) 중지 @endif
                                                </td>
                                                <td>{{ $item->AP_MODEL }}</td>
                                                <td>{{ $item->AP_FAC }}</td>
                                                <td class="sorting_1">{{ $item->REG_DT }}</td>
                                                <td>{{ $item->STORENM }}</td>
                                            </tr>
                                            @endforeach

                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">AP명</th>
                                                <th rowspan="1" colspan="1">MAC정보</th>
                                                <th rowspan="1" colspan="1">Serial No</th>
                                                <th rowspan="1" colspan="1">AP 코드</th>
                                                <th rowspan="1" colspan="1">IP</th>
                                                <th rowspan="1" colspan="1">네트워크상태정보</th>
                                                <th rowspan="1" colspan="1">모델명</th>
                                                <th rowspan="1" colspan="1">제조사</th>
                                                <th rowspan="1" colspan="1">등록일</th>
                                                <th rowspan="1" colspan="1">상점명/설치주소</th>
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
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>IP</label>
                                        <input type="text" name="ap_ip" class="form-control" placeholder="IP">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>MODEL</label>
                                        <input type="text" name="ap_model" class="form-control" placeholder="MODEL" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>제조사</label>
                                        <input type="text" name="ap_fac" class="form-control" placeholder="제조사" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Serial No</label>
                                        <input type="text" name="ap_serial" class="form-control" placeholder="Serial No" style="text-transform: uppercase;" maxlength="13" readonly >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>설치상점 ID</label>
                                        <select name="store_id" id="store_id" class="form-control store_id">
                                            <option value="">선택</option>
                                            @foreach($storeid as $storeids)
                                            <option value="{{ $storeids->STORE_ID }}">{{ $storeids->STORE_NAME }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>MAC</label>
                                        <input type="text" name="ap_mac" class="form-control" placeholder="MAC" readonly >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <span>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> AP CODE 생성</button>
                        </span>
                    </div>
                </form>
            </div>

            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
                "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]]
            }
        );
    } );


    $(document).ready(function () {

        $.validator.setDefaults({
            submitHandler: function () {
                form.submit();
            }
        });

        $('#quickForm').validate({
            rules: {

                ap_nm: { required: true },
                ap_ip: { required: true },
                store_id: { required: true }

            },
            messages: {
                ap_nm: "Please enter a AP Name",
                ap_ip: "Please enter a ip",
                store_id: "Please select a Store name",
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
    });

    var setModify = function(seq,ap_cd,ap_nm,ap_mac,ap_ip,store_id,ap_model,ap_fac,serial ){
        $('#quickForm')[0].reset();
        $(".modal-title").text("AP정보수정");
        $('#quickForm')[0].action="/nwapupdate";

        var arr1 = store_id.split("|");

        $( "input[name*='seq']" ).val(seq);
        $( "input[name*='ap_cd']" ).val(ap_cd);
        $( "input[name*='ap_nm']" ).val(ap_nm);
        $( "input[name*='ap_mac']" ).val(ap_mac);
        $( "input[name*='ap_ip']" ).val(ap_ip);
        $('#store_id').val(arr1[0]).prop("selected",true);
        // $( ".store_id" ).val(store_id);
        $( "input[name*='ap_model']" ).val(ap_model);
        $( "input[name*='ap_fac']" ).val(ap_fac);
        $( "input[name*='ap_serial']" ).val(serial);
    };

    </script>


@endsection
