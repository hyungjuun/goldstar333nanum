@extends('layouts.nwwifiv1')

@section('title', __('나눔 장비등록현황'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>전체 리스트 - 수정 </h1>
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">등록된 장비 내용을 확인 및 수정할 수 있습니다.</h3>
                            <div class=" float-sm-right">
                                <button type="button" class="btn btn-primary " onclick="location.href='{{ url('newapmgtlist') }}'" ><i class="fa fa-edit"></i> 장비등록현황 목록</button>
                            </div>
                        </div>
                        <div>
                            <div class="alert alert-warning" role="alert">
                                <p><b>* AP 상태변경 :</b> <b>대기</b> 상태 변경시 반드시 <b>회수</b> 절차를 진행해 주시기 바랍니다.</p>
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

                                    <form role="form" id="quickForm" method="post" action="newapmgtupdate" novalidate="novalidate">
                                        @csrf
                                        @foreach($list as $lists)
                                            <?php $apseq = $lists->SEQ; ?>
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
                                                                <label>AP 코드</label>
                                                                <input type="text" name="ap_cd" id="ap_cd" class="form-control" placeholder="AP 코드" readonly value="{{$lists->AP_CD}}" >
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
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>MAC</label>
                                                                <input type="text" name="ap_mac" class="form-control" placeholder="MAC" value="{{$lists->AP_MAC}}" >
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6 ">
                                                            <div class="form-group">
                                                                <label>AP 상태변경</label>
                                                                @if($lists->AP_STS == 4)
                                                                    <input type="text"  class="form-control" value="회수"  readonly >
                                                                    <input type="hidden" name="adm_sts" class="form-control" value="{{$lists->AP_STS}}"  readonly >
                                                                @else
                                                                    <select name="adm_sts" id="adm_sts" class="form-control">
                                                                        @if($lists->AP_STS == 0)
                                                                        <option value="0" @if($lists->AP_STS == 0) selected @endif >대기</option>
                                                                        @endif
                                                                        <option value="3" @if($lists->AP_STS == 3) selected @endif >등록</option>
                                                                        <option value="1" @if($lists->AP_STS == 1) selected @endif >서비스</option>
                                                                        <option value="2" @if($lists->AP_STS == 2) selected @endif >고장</option>
                                                                        <option value="4" @if($lists->AP_STS == 4) selected @endif >회수</option>
                                                                        <option value="5" @if($lists->AP_STS == 5) selected @endif >파손</option>
                                                                    </select>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>설치상점 ID</label>
                                                                <?php $now_store_id = $lists->STORE_ID; ?>
                                                                @if($lists->STORE_ID > 0)

                                                                    @foreach($storeid as $storeids)
                                                                        @if( $lists->STORE_ID == $storeids->STORE_ID)
                                                                            <input type="text"  class="form-control"  value="{{$storeids->STORE_NAME}}" readonly >
                                                                        @endif
                                                                    @endforeach
                                                                    <input type="hidden" name="store_id" id="store_id" class="form-control"  value="{{$lists->STORE_ID}}" readonly >
                                                                @else
                                                                    <select name="store_id" id="store_id" class="form-control store_id" >
                                                                        <option value="">선택</option>
                                                                        @foreach($storeid as $storeids)
                                                                            <option value="{{ $storeids->STORE_ID }}"  @if( $lists->STORE_ID == $storeids->STORE_ID) selected  @endif >{{ $storeids->STORE_NAME }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>설치 시공자 CODE</label>
                                                                <input type="text" name="ap_worker1" class="form-control" placeholder="MAC" value="{{$lists->WORKER1}}" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="modal-footer justify-content-between">
                                            <span>
                                                @if($lists->AP_STS == 4)
                                                <button type="button" class="btn btn-success col fileinput-button dz-clickable" onclick="resetcheck()"><i class="fas fa-save"></i> 장비회수 확인(초기화)</button>
                                                @endif
                                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> 수정</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="example3_wrapper" class="dataTables_wrapper dt-bootstrap4">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="card-title">AP 연동상점 정보</h4>
                                    </div>
                                    <div class="col-sm-12">
                                        <table id="example3" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="AP 연동 상점 리스트" style="width:100%;">
                                            @if(sizeof($storeinfo) < 1)
                                                <tr><td style="text-align: center;">연동된 상점 리스트 내용이 없습니다. </td></tr>
                                            @else
                                                <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" style="width: 101px;" aria-label="상점명: activate to sort column ascending">상점명</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" style="width: 101px;" aria-label="사업자등록번호: activate to sort column ascending">사업자등록번호</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" style="width: 101px;" aria-label="대표자: activate to sort column ascending">대표자</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" style="width: 101px;" aria-label="대표자 연락처: activate to sort column ascending">대표자 연락처</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" style="width: 101px;" aria-label="담당자: activate to sort column ascending">담당자</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" style="width: 101px;" aria-label="담당자 연락처: activate to sort column ascending">담당자 연락처</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" style="width: 101px;" aria-label="E-mail: activate to sort column ascending">E-mail</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example3" rowspan="1" colspan="1" aria-label="상점주소: activate to sort column ascending">상점주소</th>
                                                </tr>
                                                </thead>
                                                @foreach($storeinfo as $storeinfos )
                                                    <tr role="row" class="odd">
                                                        <td>{{ $storeinfos->STORE_NAME }}</td>
                                                        <td>{{ $storeinfos->BUSINESS_CODE }}</td>
                                                        <td>{{ $storeinfos->CEO }}</td>
                                                        <td>{{ $storeinfos->CEO_MOBILE }}</td>
                                                        <td>{{ $storeinfos->MGR }}</td>
                                                        <td>{{ $storeinfos->MGR_MOBILE }}</td>
                                                        <td>{{ $storeinfos->USEREMAIL }}</td>
                                                        <td>
                                                            [ {{ $storeinfos->POSTCODE }} ]<br/>
                                                            {{ $storeinfos->ADDRESS1 }}<br/>
                                                            {{ $storeinfos->ADDRESS2 }}<br/>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                        $ap_memo = $storeinfos->AP_MEMO;
                                                    ?>
                                                @endforeach

                                            @endif
                                        </table>
                                        @if( !empty($ap_memo) )
                                        <div>
                                            <textarea class="form-control" rows="9" readonly >{{$ap_memo}}</textarea>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <hr/>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="card-title" style="margin-bottom: 1rem">AP MEMO</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <form id="memoform" method="post" action="newapapmemoup/all" novalidate="novalidate" >
                                        @csrf
                                        <input type="hidden" name="apseq" value="{{$apseq}}">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>분류</label>
                                                    <select name="memo_tag" id="memo_tag" class="form-control" >
                                                        <option value="">선택</option>
                                                        <option value="접수">접수확인</option>
                                                        <option value="장애">장애</option>
                                                        <option value="완료">완료</option>
                                                        <option value="긴급">긴급</option>
                                                        <option value="기타">기타</option>
                                                    </select>
                                                    <div class="alert alert-warning" role="alert">
                                                        <p><b>* 접수확인 :</b> 설치접수 확인 메모</p>
                                                        <p><b>* 장애 :</b> 장애접수 및 처리에 관한 메모</p>
                                                        <p><b>* 완료 :</b> 장애, 긴급 등 완료 메모</p>
                                                        <p><b>* 긴급 :</b> 긴급요청 메모</p>
                                                        <p><b>* 기타 :</b> 기타 메모</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <label>MEMO</label>
                                                    <textarea name="apmemo" id="apmemo" class="form-control" rows="9" placeholder="문의  ..." aria-invalid="false"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="modal-footer justify-content-between">
                                                    <span>
                                                        <button type="button" onclick="btn_memo_update()" class="btn btn-primary"><i class="fas fa-save"></i> 저장</button>
                                                    </span>
                                                </div>
                                            </div>
                                    </form>

                                    <div class="col-sm-12">
                                        <table id="example2" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="AP 연동 상점 리스트" width="100%">
                                            @if(sizeof($apmemolist) < 1)
                                                <tr><td style="text-align: center;">등록된 내용이 없습니다. </td></tr>
                                            @else
                                                <thead>
                                                <tr role="row">
                                                    <th>TAG</th>
                                                    <th>MEMO</th>
                                                    <th>작성자</th>
                                                    <th>날짜</th>
                                                </tr>
                                                </thead>
                                                @foreach($apmemolist as $apmemolists )
                                                    <tr>
                                                        <td>{{ $apmemolists->TAG }}</td>
                                                        <td>{{ $apmemolists->MEMO }}</td>
                                                        <td>{{ $apmemolists->UPD_ID }}</td>
                                                        <td>{{ $apmemolists->REGDATE }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                    </div>
                                </div>
                                <hr/>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="card-title" style="margin-bottom: 1rem">AP History</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="AP 연동 상점 리스트" width="100%">
                                            @if(sizeof($aphistory) < 1)
                                                <tr><td style="text-align: center;">연동된 상점 리스트 내용이 없습니다. </td></tr>
                                            @else
                                                <thead>
                                                <tr role="row">
                                                    <th>AP_NM</th>
                                                    <th>AP_CD</th>
                                                    <th>MODEL</th>
                                                    <th>MAC</th>
                                                    <th>제조사</th>
                                                    <th>IP</th>
                                                    <th>AP_STS</th>
                                                    <th>REG_DT</th>
                                                    <th>UPD_ID</th>
                                                    <th>SERIAL_NO</th>
                                                    <th>COMMENT</th>
                                                    <th>WORKER1</th>
                                                </tr>
                                                </thead>
                                                @foreach($aphistory as $aphistorys )
                                                    <tr>
                                                        <td>{{ $aphistorys->AP_NM }}</td>
                                                        <td>{{ $aphistorys->AP_CD }}</td>
                                                        <td>{{ $aphistorys->AP_MODEL }}</td>
                                                        <td>{{ $aphistorys->AP_MAC }}</td>
                                                        <td>{{ $aphistorys->AP_FAC }}</td>
                                                        <td>{{ $aphistorys->AP_IP }}</td>
                                                        <td>
                                                            @if($aphistorys->AP_STS == 0) 대기 @endif
                                                            @if($aphistorys->AP_STS == 3) 등록 @endif
                                                            @if($aphistorys->AP_STS == 1) 서비스 @endif
                                                            @if($aphistorys->AP_STS == 2) 고장 @endif
                                                            @if($aphistorys->AP_STS == 4) 회수 @endif
                                                            @if($aphistorys->AP_STS == 5) 파손 @endif
                                                        </td>
                                                        <td>{{ $aphistorys->REG_DT }}</td>
                                                        <td>{{ $aphistorys->UPD_ID }}</td>
                                                        <td>{{ $aphistorys->SERIAL_NO }}</td>
                                                        <td>{{ $aphistorys->COMMENT }}</td>
                                                        <td>{{ $aphistorys->WORKER1 }}</td>
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
    <script>

        function btn_memo_update() {
            if($("#memo_tag option:selected").val() == ''){
                alert("분류를 선택해 주세요");
                return false;
            }

            if($("#apmemo").val() == ''){
                alert("메모를 입력해 주세요 ");
                document.getElementById('apmemo').focus();
                return false;
            }

            $('#memoform')[0].action="/newapapmemoup/all";
            $('#memoform')[0].submit();
        }


        @if($lists->AP_STS == 4)
        function resetcheck(){
            $('#quickForm')[0].reset();
            $('#quickForm')[0].action="/newapmgtreset";
            $('#quickForm')[0].submit();
        }
        @endif


        $(document).ready(function () {

            <?php /*** 스토어 상점 제어 */ ?>
            $("select[id=store_id]").change(function(){
                $("#adm_sts").val("3").prop("selected", true);

                if( $(this).val() == ""){
                    $("#adm_sts").val("0").prop("selected", true);
                }else{
                    $("#adm_sts").val("3").prop("selected", true);
                }
                <?php /*** 스토어 상점 미선택 */ ?>
                if( $(this).val() == ""  &&  $('#ap_cd').val() != "" ){
                    var result = confirm("상점 미 선택시 \n AP CODE 는 초기화(대기 상태),\n AP 상태변경: 대기로 변경됩니다.");
                    if(result){
                        $('#ap_cd').val('');
                        $("#adm_sts").val("0").prop("selected", true);
                        $("#store_id").val("{{$now_store_id}}").prop("selected", true);

                    }else{
                        $("#store_id").val("{{$now_store_id}}").prop("selected", true);
                    }
                }
            });


            <?php /*** AP 상태 제어 */ ?>
            $("select[id=adm_sts]").change(function(){
                <?php /*** 스토어 상점 미선택 */ ?>
                if($(this).val() == 0){
                    var result = confirm("상점 미 선택시 \n AP CODE 는 초기화(대기 상태),\n AP 상태변경: 대기로 변경됩니다.");
                    if(result){
                        $('#ap_cd').val('');
                        $("#adm_sts").val("0").prop("selected", true);
                    }else{
                        $("#store_id").val("{{$now_store_id}}").prop("selected", true);
                    }
                }
            });

            @if(sizeof($storeinfo) > 0)
            $('#example3').DataTable(
                {
                    "paging": false,
                    "lengthChange": false,
                    "searching": false,
                    "ordering": true,
                    "info": false,
                    "autoWidth": true,
                    "responsive": true,
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                }
            );
            @endif

            @if(sizeof($apmemolist) > 0)
            $('#example2').DataTable(
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
            @endif

            @if(sizeof($aphistory) > 0)
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
            @endif

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
                },
                submitHandler:function(){
                    $('#quickForm')[0].submit();
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
