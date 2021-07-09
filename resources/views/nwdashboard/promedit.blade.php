@extends('layouts.nwwifiv1')

@section('title', __('AP설치 상점 관리 - 수정'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>AP설치 상점 관리 - 수정</h1>
                    @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">상점 정보를 수정합니다.</h3>
                            <div class=" float-sm-right">
                                <button type="button" class="btn btn-primary " onclick="location.href='{{ url('nwpromlist') }}'" ><i class="fa fa-edit"></i> 상점관리 목록</button>
                            </div>
                        </div>

                        <form role="form" id="quickForm" method="post" action="{{ url('nwpromupdate') }}" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            @foreach($list as $lists)
                                <?php
                                $storeid = $lists->STORE_ID;
                                $ap_cd = $lists->AP_CD;
                                ?>

                            <input type="hidden" name="store_id" value="{{$lists->STORE_ID}}">
                            <input type="hidden" name="ap_storetype" value="Y">
                            <input type="hidden" name="step" value="0">
                            <input type="hidden" name="attach_file" value="">
                            <input type="hidden" name="realname" value="">
                            <input type="hidden" name="thumbnail" value="">

                            <input type="hidden" name="giftcheck" id="giftcheck" />
                            <input type="hidden" name="aptelecomcheck" id="aptelecomcheck" />
                            <input type="hidden" name="subscriptioncheck" id="subscriptioncheck" />
                            <input type="hidden" name="poscheck" id="poscheck" />

                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>상점상태</label>
                                                <select name="apcheck" id="apcheck" class="form-control">
                                                    <option value="0" @if($lists->CHECK == 0) selected @endif>가입 신청</option>
                                                    <option value="1" @if($lists->CHECK == 1) selected @endif>승인 완료</option>
                                                    <option value="2" @if($lists->CHECK == 2) selected @endif>AP 설치</option>
                                                    <option value="3" @if($lists->CHECK == 3) selected @endif>네트워크연동</option>
                                                    <option value="4" @if($lists->CHECK == 4) selected @endif>철수</option>
                                                    <option value="5" @if($lists->CHECK == 5) selected @endif>장비회수</option>
                                                    <option value="6" @if($lists->CHECK == 6) selected @endif>가입해지</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                @if($lists->APPROVAL == 0)
                                                <label>사용승인 | <span style="color: cornflowerblue">승인과 동시에 상점의 아이디 계정이 활성화 됩니다.  </span></label>
                                                <select name="ap_approval" id="ap_approval" class="form-control" onchange="approvalch(this.value)" >
                                                    <option value="0" >미승인</option>
                                                    <option value="1" >승인</option>
                                                </select>
                                                @else
                                                <label>사용승인</label>
                                                <input class="form-control" value="승인된 상점 입니다." readonly >
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>상호명 <span style="color:red;">*</span></label>
                                                <input type="text" name="store_name" maxlength="30" class="form-control" placeholder="상점명" value="{{$lists->STORE_NAME}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>사업자번호 <span style="color:red;">*</span></label>
                                                <input type="number" name="ap_business" oninput="maxLengthCheck(this)"  class="form-control" placeholder="사업자번호" maxlength="10" placeholder="0000000000" value="{{$lists->BUSINESS_CODE}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>업종 <span style="color:red;">*</span></label>
                                                <p style="display: flex; margin-bottom: 1rem;">
                                                    <input type="number" name="ap_industry" id="industry" oninput="maxLengthCheck(this)" class="form-control col-sm-2" maxlength="6" placeholder="00000" style="width: 7em; margin-right: 1rem;" value="{{$lists->INDSTURY}}" >
                                                    <button type="button" class="btn btn-info col-sm-4" onclick="codeopenPop()" >검색</button>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>업태</label>
                                                <input type="text" name="ap_instype" class="form-control col-sm-2" placeholder="업태" value="{{$lists->INS_TYPE}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>대표자 <span style="color:red;">*</span></label>
                                                <input type="text" name="ap_ceo" class="form-control"  placeholder="대표자" value="{{$lists->CEO}}" >
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>무선전화 <span style="color:red;">*</span></label>
                                                <input type="number" name="ap_ceomobile" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"   placeholder="무선전화" value="{{$lists->CEO_MOBILE}}" >
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>유선전화</label>
                                                <input type="number" name="ap_ceotelno" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"  placeholder="유선전화" value="{{$lists->CEO_TELNO}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>담당자</label>
                                                <input type="text" name="ap_mgr" class="form-control"  placeholder="담당자" value="{{$lists->MGR}}" >
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>무선전화</label>
                                                <input type="number" name="ap_mgrmobile" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"  placeholder="무선전화" value="{{$lists->MGR_MOBILE}}" >
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>유선전화</label>
                                                <input type="number" name="ap_mgrtelno" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"  placeholder="유선전화" value="{{$lists->MGR_TELNO}}" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>대표 E-mail <span style="color:red;">* 가입승인 및 기타 안내에 대한 내용을 받으실 E-mail 주소를 기재 부탁드립니다.</span> </label>
                                                <input type="email" name="ap_email" class="form-control"  placeholder="E-mail" value="{{$lists->USEREMAIL}}">
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label >우편번호 <span style="color:red;">*</span></label>
                                                <input type="text" name="postcode" id="postcode" class="form-control" placeholder="00000" value="{{$lists->POSTCODE}}"  readonly onclick="alert('주소검색 버튼을 클릭하세요! ');" >
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label >주소 <span style="color:red;">*</span></label>
                                                <input type="text" name="addr" id="addr" class="form-control" placeholder="주소" value="{{$lists->ADDRESS1}}" readonly onclick="alert('주소검색 버튼을 클릭하세요! ');" >
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label >주소상세 <span style="color:red;">*</span></label>
                                                <input type="text" name="addr1" id="addr1" class="form-control" placeholder="주소" value="{{$lists->ADDRESS2}}" >
                                                <span style="color:red;">(주소는 현재 사업장의 주소를 입력하셔야 합니다.)</span>
                                            </div>
                                            <p style="text-align: right;">
                                                <button type="button" class="btn btn-info col-sm-4" onclick="sample6_execDaumPostcode()" >주소검색</button>
                                            </p>
                                        </div>
                                    </div>
                                    <hr/>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>상품권 가맹점</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group">
                                                @foreach($giftlist as $glist)
                                                    <p>
                                                        <span class="col-sm-4" style="font-weight: bold; ">{{ $glist->giftname }}</span>
                                                        @if(!empty($glist->giftname1))  <input type="checkbox" name="giftname" value="{{$glist->giftname}}_{{$glist->giftname1}}" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">{{$glist->giftname1}}</span> @endif
                                                        @if(!empty($glist->giftname2))  <input type="checkbox" name="giftname" value="{{$glist->giftname}}_{{$glist->giftname2}}" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">{{$glist->giftname2}}</span> @endif
                                                        @if(!empty($glist->giftname3))  <input type="checkbox" name="giftname" value="{{$glist->giftname}}_{{$glist->giftname3}}" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">{{$glist->giftname3}}</span> @endif
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
                                                <textarea name="storememo" id="storememo" class="form-control" rows="3" placeholder="기타 문의  ...">{{$lists->STORE_MEMO}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <hr/>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>AP 장비셋팅 요청내용</label>
                                                <textarea name="apmemo"  class="form-control" rows="8" placeholder="AP 장비셋팅 요청내용  ...">{{$lists->AP_MEMO}}</textarea>
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
                                                <input type="text" name="ap_telecomother" class="form-control col-sm-2" placeholder="기타" value="{{$lists->TELECOMOTHER}}" />
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
                                                <input type="checkbox" name="ap_wifi_y" id="ap_wifi_y" value="Y" onclick="apwifiyncheck('y')" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">유</span>
                                                <input type="radio" name="ap_wifi_state" id="ap_wifi_state" value="자가" onclick="apwifiyncheck('a')" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">자가</span>
                                                <input type="radio" name="ap_wifi_state" id="ap_wifi_state" value="임대" onclick="apwifiyncheck('b')" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">임대</span>
                                                <input type="checkbox" name="ap_wifi_n" id="ap_wifi_n" value="N" onclick="apwifiyncheck('n')" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">무</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>AP 모델명 SSID </label>
                                                <input type="text" name="ap_ssid_id" class="form-control" value="{{$lists->STORE_WIFI_ID}}" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>AP 모델명 PW </label>
                                                <input type="text" name="ap_ssid_pw" class="form-control" value="{{$lists->STORE_WIFI_PW}}" />
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
                                                <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="1" @if($lists->AP_COMM_FEE == 1) checked @endif /><span style="margin-left: 0.5rem; margin-right: 2rem; ">1 만원 ~ </span>
                                                <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="2" @if($lists->AP_COMM_FEE == 2) checked @endif /><span style="margin-left: 0.5rem; margin-right: 2rem; ">2 만원 ~ </span>
                                                <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="3" @if($lists->AP_COMM_FEE == 3) checked @endif /><span style="margin-left: 0.5rem; margin-right: 2rem; ">3 만원 ~ </span>
                                                <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="4" @if($lists->AP_COMM_FEE == 4) checked @endif /><span style="margin-left: 0.5rem; margin-right: 2rem; ">4 만원 ~ </span>
                                                <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="5" @if($lists->AP_COMM_FEE == 5) checked @endif /><span style="margin-left: 0.5rem; margin-right: 2rem; ">5 만원 ~ </span>
                                            </div>
                                        </div>
                                    </div>
                                    <HR/>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>전단지 1</label>
                                                <input type="file" name="filenames[]" class="form-control" placeholder="전단지">
                                                <img id="imgfile1" src="/default.jpg" width="100px" height="100px" />
                                                <input type="file" name="filenames[]" class="form-control" placeholder="전단지">
                                                <img id="imgfile2" src="/default.jpg" width="100px" height="100px" />
                                                <input type="file" name="filenames[]" class="form-control" placeholder="전단지">
                                                <img id="imgfile3" src="/default.jpg" width="100px" height="100px" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <span>
                                    @if($lists->ACTIVEFLAG == "Y")
                                        @if(Auth::user()->user_id == 1 || Auth::user()->storelevel == 1)
                                        <button type="button" class="btn btn-danger delBtn" data-toggle="modal" data-target="#modal-lg" onclick="addForm();"><i class="far fa-trash-alt"></i> 삭제</button>
                                        @endif
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> 수정</button>
                                    @endif
                                </span>
                            </div>
                                <?php
                                $gift_card = $lists->gift_card;
                                $telecom = $lists->TELECOM;
                                $ubscription = $lists->SUBSCRIPTION;
                                $appos = $lists->APPOS;
                                $storewifi = $lists->STORE_WIFI;
                                $storewificheck = $lists->STORE_WIFI_CHECK;
                                ?>
                                <?php /*** Real Name */ ?>
                                @if(is_array(@unserialize($lists->ATTACH_REALNAME)))
                                    <?php
                                    $realname = implode("|", unserialize($lists->ATTACH_REALNAME));
                                    ?>
                                @else
                                    <?php  $realname = ""; ?>
                                @endif

                                <?php /*** Thumbnail File */ ?>
                                @if(is_array(@unserialize($lists->THUMBNAIL_FILE)))
                                    <?php
                                    $thumbnail = implode("|", unserialize($lists->THUMBNAIL_FILE));
                                    ?>
                                @else
                                    <?php $thumbnail = ""; ?>
                                @endif

                                <?php /*** Attch File */ ?>
                                @if(is_array(@unserialize($lists->ATTACH_FILE)))
                                    <?php
                                    $imglists = implode("|", unserialize($lists->ATTACH_FILE));
                                    ?>
                                @else
                                    <?php  $imglists = ""; ?>
                                @endif

                        @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="modal-lg" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">상점삭제</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" id="quickForm1" method="post" action="/nwpromdel" novalidate="novalidate">
                    @csrf
                    <input type="hidden" name="store_id" value="{{$storeid}}">
                    <input type="hidden" name="store_type" value="Y">
                    <input type="hidden" name="ap_cd" value="{{$ap_cd}}">
                    <div class="modal-body">
                        <div class="card-body">
                            <h4>‘상점명’ 정보를 삭제하시겠습니까?</h4>
                            <hr/>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>삭제사유</label>
                                        <input type="text" name="ap_delcomment" id="ap_delcomment" class="form-control" placeholder="삭제 사유를 입력해 주세요">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-primary" onclick="btn_del()"><i class="fas fa-save"></i> 확인</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">취소</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        $(document).ready(function () {

            <?php /*** checkbos gift 전체 선택 해제  */ ?>
            var giftcard = "{{$gift_card}}";
            var arrDay = giftcard.split(',');
            for (var nArrCnt in arrDay) {
                console.log(arrDay[nArrCnt]);
                $("input[name=giftname][value='"+arrDay[nArrCnt]+"']").attr("checked",true);
            }

            <?php /*** checkbos 통신사 전체 선택 해제  */ ?>
            var telecom = "{{$telecom}}";
            var arrtelecom = telecom.split(',');
            for (var nArrCnt in arrtelecom) {
                $("input[name=ap_telecom][value='"+arrtelecom[nArrCnt]+"']").attr("checked",true);
            }

            <?php /*** checkbos 가입상품 전체 선택 해제  */ ?>
            var subscription = "{{$ubscription}}";
            var arrsubscription = subscription.split(',');
            for (var nArrCnt in arrsubscription) {
                $("input[name=ap_subscription][value='"+arrsubscription[nArrCnt]+"']").attr("checked",true);
            }

            <?php /*** checkbos POS 전체 선택 해제  */ ?>
            var appos = "{{$appos}}";
            var arrappos = appos.split(',');
            for (var nArrCnt in arrappos) {
                $("input[name=ap_pos][value='"+arrappos[nArrCnt]+"']").attr("checked",true);
            }

            <?php /*** checkbos wifi 공유기 전체 선택 해제  */ ?>
            var storewifi = "{{$storewifi}}";
            if(storewifi == "Y"){
                $("input[name=ap_wifi_y][value='Y']").attr("checked",true);
                $("input[name=ap_wifi_n][value='N']").attr("checked",false);
            }
            if(storewifi == "N"){
                $("input[name=ap_wifi_y][value='Y']").attr("checked",false);
                $("input[name=ap_wifi_n][value='N']").attr("checked",true);
            }

            var storewificheck = "{{$storewificheck}}";
            $("input:radio[name='ap_wifi_state']").removeAttr("checked");
            $("input:radio[name='ap_wifi_state']:radio[value='"+storewificheck+"']").prop("checked",true);

            <?php /*** Real Name   */ ?>
            var realname = "{{$realname}}";
            $( "input[name*='realname']" ).val(realname);

            <?php /*** Thumbnail File   */ ?>
            var thumbnail = "{{$thumbnail}}";
            $( "input[name*='thumbnail']" ).val(thumbnail);

            <?php /*** 첨부파일   */ ?>
            var attach_file = "{{$imglists}}";
            $( "input[name*='attach_file']" ).val(attach_file);

            const arr = attach_file.split("|");
            console.log("arr value => "+arr);

            if(arr[0] != "" ){
                $("#imgfile1").attr("src", arr[0]);
            }else{
                $("#imgfile1").attr("src", "/default.jpg");
            }
            if(arr[1] != "" ){
                $("#imgfile2").attr("src", arr[1]);
            }else{
                $("#imgfile2").attr("src", "/default.jpg");
            }
            if(arr[2] != "" ){
                $("#imgfile3").attr("src", arr[2]);
            }else{
                $("#imgfile3").attr("src", "/default.jpg");
            }


            $('#quickForm').validate({
                rules: {

                    store_name: { required: true },
                    ap_business: { required: true, minlength: 10 },
                    ap_industry: { required: true, minlength: 5 },
                    ap_ceo: { required: true },
                    ap_ceomobile: { required: true },
                    addr1: { required: true  },
                    ap_email: { required: true, email: true }

                },
                messages: {
                    store_name: "상호명을 입력해 주세요",
                    ap_business: "사업자번호를 입력해 주세요",
                    ap_industry: "업종을 입력해 주세요",
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
                    $('#quickForm')[0].submit();
                }
            });
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

        <?php /*** 와이파이 유무 체크 */ ?>
        function apwifiyncheck(ch) {
            if(ch == 'y'){
                // console.log('유');
                if($(ap_wifi_y).is(":checked") == true) {
                    $("input:checkbox[id='ap_wifi_n']").prop("checked", false);
                }else{
                    $("input:radio[name='ap_wifi_state']").removeAttr("checked");
                }
            }

            if(ch == 'n'){
                // console.log('무');
                $("input:checkbox[id='ap_wifi_y']").prop("checked", false);
                $("input:radio[name='ap_wifi_state']").removeAttr("checked");
            }

            if(ch == 'a'){
                // console.log('자가');
                $("input:checkbox[id='ap_wifi_y']").prop("checked", true);
                $("input:checkbox[id='ap_wifi_n']").prop("checked", false);
            }

            if(ch == 'b'){
                // console.log('임대');
                $("input:checkbox[id='ap_wifi_y']").prop("checked", true);
                $("input:checkbox[id='ap_wifi_n']").prop("checked", false);
            }

        }

        <?php /*** 슈퍼관리자 : 1 | NMS 관리자 : 1 */ ?>
        function addForm(){
            $('#quickForm1')[0].reset();
            $('#quickForm1')[0].action="/nwpromdel";
        }

        function btn_del() {
            if( $('#ap_delcomment').val() == ''){
                alert('삭제사유를 입력해 주세요! ');
                $('#ap_delcomment').focus();
                return false;
            }
            $('#quickForm1')[0].submit();
        }

        function approvalch(chval) {
            if(chval == 1){
                $('#apcheck').val('1').prop("selected",true);
            }else{
                $('#apcheck').val('0').prop("selected",true);
            }
        }

    </script>

@endsection
