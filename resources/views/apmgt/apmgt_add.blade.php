@extends('layouts.nwwifiv1')

@section('title', __('나눔 장비등록현황'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>신규장비 등록</h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">신규 장비를 등록합니다. </h3>
                            <div class=" float-sm-right">
                                <button type="button" class="btn btn-primary " onclick="location.href='{{ url('newapmgtlist') }}'" ><i class="fa fa-edit"></i> 장비등록현황 목록</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="example1_wrapper">
                                <form role="form" id="quickForm" method="post" action="newapmgtinsert" novalidate="novalidate">
                                    @csrf
                                <div class="row">
                                    <input type="hidden" name="seq" value="">
                                    <div class="modal-body">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>AP명</label>
                                                        <input type="text" name="ap_nm" class="form-control" placeholder="AP명" value="" >
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>AP 코드</label>
                                                        <input type="text" name="ap_cd" class="form-control" placeholder="AP 코드" readonly value="" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>IP</label>
                                                        <input type="text" name="ap_ip" id="ap_ip" class="form-control" placeholder="xxx.xxx.xxx.xxx" value="" >
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>MODEL</label>
                                                        <input type="text" name="ap_model" class="form-control" placeholder="MODEL" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <!-- text input -->
                                                    <div class="form-group">
                                                        <label>제조사</label>
                                                        <input type="text" name="ap_fac" class="form-control" placeholder="제조사" value="" >
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Serial No</label>
                                                        <input type="text" name="ap_serial" class="form-control" placeholder="Serial No" style="text-transform: uppercase;" maxlength="13" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row apsts">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>MAC</label>
                                                        <input type="text" name="ap_mac" class="form-control" placeholder="MAC" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <span>
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> 등록</button>
                                        </span>
                                    </div>

                                </div>
                                </form>
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

        $(document).ready(function () {

            // var ipv4_address = $('#ap_ip');
            // ipv4_address.inputmask({
            //     alias: "ip",
            //     greedy: false //The initial mask shown will be "" instead of "-____".
            // });

            $.validator.setDefaults({
                submitHandler: function () {
                    form.submit();
                }
            });

            $('#quickForm').validate({
                rules: {
                    ap_nm: { required: true },
                    ap_serial: { required: true },
                    ap_model: { required: true },
                    ap_fac: { required: true }
                },
                messages: {

                    ap_nm: "AP 이름을 입력해 주세요",
                    ap_serial: "제품 시리얼 정보를 입력해 주세요",
                    ap_model: "제품 모델정보를 입력해 주세요",
                    ap_fac: "제조사 정보를 입력해 주세요"
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

    </script>

@endsection
