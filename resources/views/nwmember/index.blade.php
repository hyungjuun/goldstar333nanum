@extends('layouts.nwwifiv1')

@section('title', __('나눔와이파이 회원가입 신청'))

@section('content')
    <div class="container-fluid">
        <div class="row pagerow" >
            <div class="col-md-10 col-xs-12 pagerow_conbg" >
                <h1>나눔와이파이 회원가입 신청</h1>
                <form role="form" id="quickForm" method="post" action="/signupadd" novalidate="novalidate" onSubmit="return false;" >
                    @csrf
                    <input type="hidden" name="giftcheck" id="giftcheck" />
                    <input type="hidden" name="aptelecomcheck" id="aptelecomcheck" />
                    <input type="hidden" name="subscriptioncheck" id="subscriptioncheck" />
                    <input type="hidden" name="poscheck" id="poscheck" />
                    <input type="hidden" name="ap_storetype" id="ap_storetype1" value="Y" />

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

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>상호명 <span style="color:red;">*</span></label>
                                        <input type="text" name="storename"  class="form-control" placeholder="상호명" required onkeyup="inputcharacterCheck(this)" onkeydown="inputcharacterCheck(this)" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>사업자번호 <span style="color:red;">* - 없이 숫자만 입력해 주세요</span></label>
                                        <input type="number" name="ap_business" oninput="maxLengthCheck(this)"  class="form-control" maxlength="10" placeholder="0000000000" onkeyup="inputcharacterCheck(this)" onkeydown="inputcharacterCheck(this)" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>업종</label>
                                        <p style="display: flex; margin-bottom: 1rem;">
                                            <input type="number" name="ap_industry" id="industry" oninput="maxLengthCheck(this)" class="form-control col-sm-2" maxlength="6" placeholder="00000" style="width: 7em; margin-right: 1rem;">
                                            <button type="button" class="btn btn-info col-sm-4" onclick="codeopenPop()" >검색</button>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>업태</label>
                                        <input type="text" name="ap_instype" class="form-control col-sm-2" placeholder="업태" onkeyup="inputcharacterCheck(this)" onkeydown="inputcharacterCheck(this)" />
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>대표자 <span style="color:red;">*</span></label>
                                        <input type="text" name="ap_ceo" class="form-control"  placeholder="대표자" onkeyup="inputcharacterCheck(this)" onkeydown="inputcharacterCheck(this)" />
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>무선전화 <span style="color:red;">* - 없이 숫자만 입력해 주세요</span></label>
                                        <input type="number" name="ap_ceomobile" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"   placeholder="무선전화">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>유선전화 <span style="color:red;">* - 없이 숫자만 입력해 주세요</span></label>
                                        <input type="number" name="ap_ceotelno" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"  placeholder="유선전화">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>담당자</label>
                                        <input type="text" name="ap_mgr" class="form-control"  placeholder="담당자" onkeyup="inputcharacterCheck(this)" onkeydown="inputcharacterCheck(this)" />
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>무선전화 <span style="color:red;">* - 없이 숫자만 입력해 주세요</span></label>
                                        <input type="number" name="ap_mgrmobile" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"  placeholder="무선전화">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>유선전화 <span style="color:red;">* - 없이 숫자만 입력해 주세요</span></label>
                                        <input type="number" name="ap_mgrtelno" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"  placeholder="유선전화">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>대표 E-mail <span style="color:red;">* 가입승인 및 기타 안내에 대한 내용을 받으실 E-mail 주소를 기재 부탁드립니다.</span> </label>
                                        <input type="email" name="ap_email" class="form-control"  placeholder="E-mail">
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label >우편번호 <span style="color:red;">*</span></label>
                                        <input type="text" name="postcode" id="postcode" class="form-control" placeholder="00000" readonly onclick="alert('주소검색 버튼을 클릭하세요! ');" >
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label >주소 <span style="color:red;">*</span></label>
                                        <input type="text" name="addr" id="addr" class="form-control" placeholder="주소" readonly onclick="alert('주소검색 버튼을 클릭하세요! ');" >
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label >주소상세 <span style="color:red;">*</span></label>
                                        <input type="text" name="addr1" id="addr1" class="form-control" placeholder="주소상세" onkeyup="inputcharacterCheck(this)" onkeydown="inputcharacterCheck(this)" />
                                        <span style="color:red;">(주소는 현재 사업장의 주소를 입력하셔야 합니다.)</span>
                                    </div>
                                    <p style="text-align: right;"><button type="button" class="btn btn-info col-sm-4" onclick="sample6_execDaumPostcode()" >주소검색</button></p>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>상품권 가맹점</label>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        @foreach($list as $item)
                                        <p class="col-sm-12 col-xs-12" style="margin-bottom: 1rem;">
                                            <span class="col-sm-3 col-xs-12" style="font-weight: bold; ">{{ $item->giftname }}</span>
                                            @if(!empty($item->giftname1))  <span class="col-sm-3 col-xs-12"><input type="checkbox" name="giftname" value="{{$item->giftname}}_{{$item->giftname1}}" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">{{$item->giftname1}}</span></span> @endif
                                            @if(!empty($item->giftname2))  <span class="col-sm-3 col-xs-12"><input type="checkbox" name="giftname" value="{{$item->giftname}}_{{$item->giftname2}}" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">{{$item->giftname2}}</span></span> @endif
                                            @if(!empty($item->giftname3))  <span class="col-sm-3 col-xs-12"><input type="checkbox" name="giftname" value="{{$item->giftname}}_{{$item->giftname3}}" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">{{$item->giftname3}}</span></span> @endif
                                        </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>메모</label>
                                        <textarea name="storememo" class="form-control" rows="3" placeholder="기타 문의  ..."   onkeyup="characterCheck()" onkeydown="characterCheck()" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>통신사</label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <input type="checkbox" name="ap_telecom" value="KT" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">KT</span>
                                        <input type="checkbox" name="ap_telecom" value="SKBB" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">SKBB</span>
                                        <input type="checkbox" name="ap_telecom" value="LGU+" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">LGU+</span>
                                        <input type="checkbox" name="ap_telecom" value="헬로비젼" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">헬로비젼</span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="ap_telecomother" class="form-control col-sm-2" placeholder="기타" onkeyup="inputcharacterCheck(this)" onkeydown="inputcharacterCheck(this)" />
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>가입상품</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="checkbox" name="ap_subscription" value="인터넷" /><span style="margin-left: 0.5rem; margin-right: 1.5rem; ">인터넷</span>
                                        <input type="checkbox" name="ap_subscription" value="TV" /><span style="margin-left: 0.5rem; margin-right: 1.5rem; ">TV</span>
                                        <input type="checkbox" name="ap_subscription" value="전화" /><span style="margin-left: 0.5rem; margin-right: 1.5rem; ">전화</span>
                                        <input type="checkbox" name="ap_subscription" value="POS" /><span style="margin-left: 0.5rem; margin-right: 1.5rem; ">POS</span>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>POS</label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="checkbox" name="ap_pos" value="인터넷" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">인터넷</span>
                                        <input type="checkbox" name="ap_pos" value="전화선" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">전화선</span>
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>와이파이 공유기</label>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="checkbox" name="ap_wifi_y" id="ap_wifi_y" value="Y" onclick="apwifiyncheck('y')" /><span style="margin-left: 0.5rem; margin-right: 0.5rem; ">유</span><span style="margin-left: 0.5rem; margin-right: 0.8rem; ">/</span><input type="checkbox" name="ap_wifi_n" id="ap_wifi_n" value="N" onclick="apwifiyncheck('n')" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">무</span>
                                        <input type="radio" name="ap_wifi_state" id="ap_wifi_state" value="자가" onclick="apwifiyncheck('a')" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">자가</span>
                                        <input type="radio" name="ap_wifi_state" id="ap_wifi_state" value="임대" onclick="apwifiyncheck('b')" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">임대</span>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>AP 모델명 SSID </label>
                                        <input type="text" name="ap_ssid_id" class="form-control" onkeyup="inputcharacterCheck(this)" onkeydown="inputcharacterCheck(this)" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>AP 모델명 PW </label>
                                        <input type="text" name="ap_ssid_pw" class="form-control"  />
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>통신요금</label>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="1" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">1 만원 ~ </span>
                                        <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="2" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">2 만원 ~ </span>
                                        <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="3" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">3 만원 ~ </span>
                                        <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="4" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">4 만원 ~ </span>
                                        <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="5" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">5 만원 ~ </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <span>
{{--                            <button type="button" onclick="sendclick()" class="btn btn-primary"><i class="fas fa-save"></i> 등록신청</button>--}}
                            <button type="submit" class="btn btn-primary" onclick="sendform()" ><i class="fas fa-save"></i> 등록신청</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        HTML {
            height: 100%;
        }
        BODY {
            height: 100vh;
            /*background-image: url("https://cdn.pixabay.com/photo/2017/02/08/17/24/fantasy-2049567_960_720.jpg");*/
            background-image: url("/images/bg_login.jpg");
            background-position: center center;
            background-repeat: repeat;
            background-size: cover;
        }

        .pagerow_conbg { float: none; margin: 0 auto; background-color: #fff; border-radius: 1rem;  padding: 1rem;    }
        .pagerow h1 {text-align: center; color: gray; padding: 2rem; }
        .pagerow h3 {text-align: center; color: gray; padding: 2rem;}
        .modal-body { border-top: 1px solid gray; }
    </style>
@endpush

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
@section('scripts')
    <script>

        function sendform(){
            $('#quickForm').validate({
                rules: {
                    storename : { required: true },
                    ap_business: { required: true },
                    ap_ceo: { required: true },
                    ap_ceomobile: { required: true },
                    addr1: { required: true  },
                    ap_email: { required: true, email: true }

                },
                messages: {
                    storename : "상호명을 입력해 주세요",
                    ap_business: "사업자번호를 입력해 주세요",
                    ap_ceo: "대표자명을 입력해 주세요",
                    ap_ceomobile: "유선전화를 입력해 주세요",
                    addr1: "주소검색 버튼을 활용하여 주소를 입력해 주세요",
                    ap_email: "이메일 주소형식이 아닙니다."
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
                    sendclick();
                }
            });

        }


        $(document).ready(function () {
            <?php /* 자동 입력폼 막기 */?>
            $("#quickForm").keydown(function (event)
            {
                if (event.keyCode == '13') {
                    if (window.event)
                    {
                        event.preventDefault();
                        return;
                    }
                }
            });


            <?php /*
            $('#quickForm').validate({
                rules: {
                    storename : { required: true },
                    ap_business: { required: true },
                    ap_ceo: { required: true },
                    ap_ceomobile: { required: true },
                    addr1: { required: true  },
                    ap_email: { required: true, email: true }

                },
                messages: {
                    storename : "상호명을 입력해 주세요",
                    ap_business: "사업자번호를 입력해 주세요",
                    ap_ceo: "대표자명을 입력해 주세요",
                    ap_ceomobile: "유선전화를 입력해 주세요",
                    addr1: "주소검색 버튼을 활용하여 주소를 입력해 주세요",
                    ap_email: "이메일 주소형식이 아닙니다."
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
                    sendclick();
                }
            });
            */ ?>
        });

        function sendclick() {

            var giftarr = new Array();
            var aptelecom = new Array();
            var apsubscription = new Array();
            var appos = new Array();

            {{-- 체크값 가져오기        --}}
            $("input[name=giftname]:checked").each(function() {
                giftarr.push($(this).val());
            });
            $('#giftcheck').val(giftarr);
            console.log(giftarr);

            // 통신사
            $("input[name=ap_telecom]:checked").each(function() {
                aptelecom.push($(this).val());
            });
            $('#aptelecomcheck').val(aptelecom);
            console.log(aptelecom);

            // 가입상품
            $("input[name=ap_subscription]:checked").each(function() {
                apsubscription.push($(this).val());
            });
            $('#subscriptioncheck').val(apsubscription);
            console.log(apsubscription);

            // POS
            $("input[name=ap_pos]:checked").each(function() {
                appos.push($(this).val());
            });
            $('#poscheck').val(appos);
            console.log(appos);

            $('#quickForm')[0].submit();
        }


        <?php /*** 와이파이 유무 체크 */ ?>
        function apwifiyncheck(ch) {
            if(ch == 'y'){
                if($(ap_wifi_y).is(":checked") == true) {
                    $("input:checkbox[id='ap_wifi_n']").prop("checked", false);
                }else{
                    $("input:radio[name='ap_wifi_state']").removeAttr("checked");
                }
            }

            if(ch == 'n'){
                $("input:checkbox[id='ap_wifi_y']").prop("checked", false);
                $("input:radio[name='ap_wifi_state']").removeAttr("checked");
            }

            if(ch == 'a'){
                $("input:checkbox[id='ap_wifi_y']").prop("checked", true);
                $("input:checkbox[id='ap_wifi_n']").prop("checked", false);
            }

            if(ch == 'b'){
                $("input:checkbox[id='ap_wifi_y']").prop("checked", true);
                $("input:checkbox[id='ap_wifi_n']").prop("checked", false);
            }

        }

        function maxLengthCheck(object){
            if (object.value.length > object.maxLength){
                //object.maxLength : 매게변수 오브젝트의 maxlength 속성 값입니다.
                object.value = object.value.slice(0, object.maxLength);
            }
        }

        function sample6_execDaumPostcode() {
            new daum.Postcode({
                oncomplete: function(data) {
                    // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                    // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                    // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수

                    //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                    if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                        addr = data.roadAddress;
                    } else { // 사용자가 지번 주소를 선택했을 경우(J)
                        addr = data.jibunAddress;
                    }

                    // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                    if(data.userSelectedType === 'R'){
                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                            extraAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if(data.buildingName !== '' && data.apartment === 'Y'){
                            extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if(extraAddr !== ''){
                            extraAddr = ' (' + extraAddr + ')';
                        }
                        // 조합된 참고항목을 해당 필드에 넣는다.
                        document.getElementById("addr").value = extraAddr;

                    } else {
                        document.getElementById("addr").value = '';
                    }

                    // 우편번호와 주소 정보를 해당 필드에 넣는다.
                    document.getElementById('postcode').value = data.zonecode;
                    document.getElementById("addr").value = addr+extraAddr;

                }
            }).open();
        }

        function codeopenPop(){
            var popup = window.open('/searchcode', '업종코드검색', 'width=700px,height=800px,scrollbars=yes');
        }

        function characterCheck() {
            var RegExp = /[\{\}\[\]\/,;:|\)*~`!^\-_+┼<>@\#$%&\'\"\\\(\=]/gi;
            var obj = document.getElementsByName("storememo")[0];
            if (RegExp.test(obj.value)) {
                alert("특수문자는 입력하실 수 없습니다.");
                obj.value = obj.value.substring(0, obj.value.length - 1);
            }
        }

        function inputcharacterCheck(obj) {
            var RegExp = /[\{\}\[\]\/,;:|\)*~`!^\_+┼<>@\#$%&\'\"\\\(\=]/gi;

            if (RegExp.test(obj.value)) {
                alert("특수문자는 입력하실 수 없습니다.");
                obj.value = obj.value.substring(0, obj.value.length - 1);
            }
        }



    </script>
@endsection

