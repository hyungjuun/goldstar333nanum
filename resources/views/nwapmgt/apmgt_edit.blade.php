@extends('layouts.nwwifiv1')

@section('title', __('나눔 장비등록현황'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>장비등록현황 - 수정 </h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">등록된 장비 내용을 확인 및 수정할 수 있습니다.</h3>
                            <div class=" float-sm-right">
                                <button type="button" class="btn btn-primary " onclick="location.href='{{ url('nwapmgtlist') }}'" ><i class="fa fa-edit"></i> 장비등록현황 목록</button>
                            </div>
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

                                    <form role="form" id="quickForm" method="post" action="nwapmgtupdate" novalidate="novalidate">
                                        @csrf
                                        @foreach($list as $lists)
                                        <input type="hidden" name="seq" value="{{$lists->SEQ}}">
                                        <div class="modal-body">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>AP명</label>
                                                            <input type="text" name="ap_nm" class="form-control" placeholder="AP명" value="{{$lists->AP_NM}}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>AP CD</label>
                                                            <input type="text" name="ap_cd" class="form-control" placeholder="AP CD" readonly value="{{$lists->AP_CD}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>IP</label>
                                                            <input type="text" name="ap_ip" id="ap_ip" class="form-control" placeholder="xxx.xxx.xxx.xxx" value="{{$lists->AP_IP}}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>MODEL</label>
                                                            <input type="text" name="ap_model" class="form-control" placeholder="MODEL" value="{{$lists->AP_MODEL}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <!-- text input -->
                                                        <div class="form-group">
                                                            <label>제조사</label>
                                                            <input type="text" name="ap_fac" class="form-control" placeholder="제조사" value="{{$lists->AP_FAC}}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Serial No</label>
                                                            <input type="text" name="ap_serial" class="form-control" placeholder="Serial No" style="text-transform: uppercase;" maxlength="13" value="{{$lists->SERIAL_NO}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row apsts">
                                                    <div class="col-sm-6 ">
                                                        <div class="form-group">
                                                            <label>AP 상태변경</label>
                                                            <select name="adm_sts" class="form-control">
                                                                <option value="">선택</option>
                                                                <option value="0" @if($lists->ADM_STS == 0) selected @endif >등록</option>
                                                                <option value="1" @if($lists->ADM_STS == 1) selected @endif >서비스</option>
                                                                <option value="2" @if($lists->ADM_STS == 2) selected @endif >중지</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 sts_stop">
                                                        <div class="form-group">
                                                            <label>중지사유</label>
                                                            <select name="ap_sts_reason" class="form-control">
                                                                <option value="">선택</option>
                                                                <option value="1" @if($lists->AP_STS_REASON == 1) selected @endif >분실</option>
                                                                <option value="2" @if($lists->AP_STS_REASON == 2) selected @endif >고장</option>
                                                                <option value="3" @if($lists->AP_STS_REASON == 3) selected @endif >파손</option>
                                                                <option value="4" @if($lists->AP_STS_REASON == 4) selected @endif >회수</option>
                                                                <option value="5" @if($lists->AP_STS_REASON == 5) selected @endif >종료</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>MAC</label>
                                                            <input type="text" name="ap_mac" class="form-control" placeholder="MAC" value="{{$lists->AP_MAC}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                        <div class="modal-footer justify-content-between">
                                            <span>
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> 수정</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="card-title">AP 연동상점 리스트</h4>
                                    </div>
                                    <div class="col-sm-12">

                                        <table class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="AP 연동 상점 리스트" width="100%">
                                            @if(sizeof($apcodelist) < 1)
                                                <tr><td>연동된 상점 리스트 내용이 없습니다. </td></tr>
                                            @else
                                                <thead>
                                                <tr role="row">
                                                    <th>상점명</th>
                                                    <th>사업자등록번호</th>
                                                    <th>대표자</th>
                                                    <th>대표자 연락처</th>
                                                    <th>담당자</th>
                                                    <th>담당자 연락처</th>
                                                    <th>E-mail</th>
                                                    <th>상점주소</th>

                                                </tr>
                                                </thead>
                                                @foreach($apcodelist as $aplists )
                                                <tr>
                                                    <td>{{ $aplists->STORE_NAME }}</td>
                                                    <td>{{ $aplists->BUSINESS_CODE }}</td>
                                                    <td>{{ $aplists->CEO }}</td>
                                                    <td>{{ $aplists->CEO_MOBILE }}</td>
                                                    <td>{{ $aplists->MGR }}</td>
                                                    <td>{{ $aplists->MGR_MOBILE }}</td>
                                                    <td>{{ $aplists->USEREMAIL }}</td>
                                                    <td>
                                                        {{ $aplists->POSTCODE }}
                                                        {{ $aplists->ADDRESS1 }}
                                                        {{ $aplists->ADDRESS2 }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
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
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
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
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                }
            );
        } );


        $(document).ready(function () {

            if({{$lists->ADM_STS}} == 2){
                $(".sts_stop").show();
            }else{
                $(".sts_stop").hide();
            }

            var ipv4_address = $('#ap_ip');
            ipv4_address.inputmask({
                alias: "ip",
                greedy: false //The initial mask shown will be "" instead of "-____".
            });

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
