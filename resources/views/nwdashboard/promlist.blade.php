@extends('layouts.nwwifiv1')

@section('title', __('AP설치 상점 관리'))

@section('content')
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1>AP설치 상점 관리</h1>
                    @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif

                </div>

                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header col-sm-12">
                            <h3 class="card-title">상점 정보를 관리합니다.</h3>
                            @if(Auth::user()->level == 10 )
                            <div class=" float-sm-right">
                                <button type="button" class="btn btn-primary " onclick="location.href='{{ url('nwpromnew') }}'" ><i class="fa fa-edit"></i> 신규등록</button>
                            </div>
                            @endif
                        </div>

                        <div class="card-body">
                            <form id="serchselect" name="serchselect" method="post" action="/nwpromserchlist" >
                                @csrf
                                <input type="hidden" name="selchval" id="selchval" />

                            </form>
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info" style="width: 100%;">
                                            <thead>
                                            <tr role="row">
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 110px;" aria-sort="descending" aria-label="상점서비스 상태: activate to sort column ascending">상점서비스 상태</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="상점명: activate to sort column ascending">상점명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="사업자번호: activate to sort column ascending">사업자번호</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="대표자명: activate to sort column ascending">대표자명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="담당자명: activate to sort column ascending">담당자명</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="업종: activate to sort column ascending">업종</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;" aria-label="업태: activate to sort column ascending">업태</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 200px;" aria-label="주소: activate to sort column ascending">주소</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="" aria-label="전단지: activate to sort column ascending">전단지</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($list as $lists)
                                                @if(is_array(@unserialize($lists->ATTACH_FILE)))
                                                    <?php
                                                        $imglists = implode("|", unserialize($lists->ATTACH_FILE));
                                                    ?>
                                                    @else
                                                    <?php  $imglists = ""; ?>
                                                @endif

                                                @if($lists->STORETYPE == "Y")
                                                    <?php
                                                    $click_url = "/nwpromedit/".$lists->STORE_ID;
                                                    ?>
                                                @else
                                                    <?php
                                                    $click_url = "/nwpromedit/".$lists->STORE_ID;
                                                    ?>
                                                @endif
                                            <tr data-target="#modal-lg"
                                            @if($lists->CHECK == 6)
                                                style="background-color: #ffb1cd;"
                                            @endif

                                            >
                                                <td role="row" class="odd" onclick="location.href='{{ $click_url }}'">
                                                    @switch($lists->CHECK)
                                                        @case(0)
                                                        가입신청
                                                        @break

                                                        @case(1)
                                                        승인완료
                                                        @break

                                                        @case(2)
                                                        AP 설치
                                                        @break

                                                        @case(3)
                                                        네트워크 연동
                                                        @break

                                                        @case(4)
                                                        철수
                                                        @break

                                                        @case(5)
                                                        장비회수
                                                        @break

                                                        @case(6)
                                                        가입해지<br/>
                                                        <b>삭제사유 :</b> {{ $lists->COMMENT }}
                                                        @break

                                                        @default

                                                    @endswitch
                                                </td>
                                                <td role="row" class="odd" onclick="location.href='{{ $click_url }}'" >{{ $lists->STORE_NAME }}</td>
                                                <td role="row" class="odd" onclick="location.href='{{ $click_url }}'" >{{ $lists->BUSINESS_CODE }} </td>
                                                <td role="row" class="odd" onclick="location.href='{{ $click_url }}'" >{{ $lists->CEO }} <br/> 무선: {{ $lists->CEO_MOBILE }} <br/> 유선: {{ $lists->CEO_TELNO }}</td>
                                                <td role="row" class="odd" onclick="location.href='{{ $click_url }}'" >{{ $lists->MGR }} <br/> 무선: {{ $lists->MGR_MOBILE }} <br/> 유선: {{ $lists->MGR_TELNO }}</td>
                                                <td role="row" class="odd" onclick="location.href='{{ $click_url }}'" >{{ $lists->INDSTURY }} </td>
                                                <td role="row" class="odd" onclick="location.href='{{ $click_url }}'" >{{ $lists->INS_TYPE }} </td>
                                                <td role="row" class="odd" onclick="location.href='{{ $click_url }}'" >
                                                    {{ $lists->POSTCODE }} <BR/>
                                                    {{ $lists->ADDRESS1 }} <BR/>
                                                    {{ $lists->ADDRESS2 }}
                                                </td>
                                                <td align="center">


                                                    @if(is_array(@unserialize($lists->ATTACH_FILE)))

                                                        @if(is_array(@unserialize($lists->ATTACH_REALNAME)))
                                                            <?php
                                                            $realname = implode("|", unserialize($lists->ATTACH_REALNAME));
                                                            $realnamearr = explode("|", $realname);
                                                            ?>
                                                        @else
                                                            <?php  $realname = ""; ?>
                                                        @endif

                                                        @if(is_array(@unserialize($lists->THUMBNAIL_FILE)))
                                                            <?php
                                                            $thumbnail = implode("|", unserialize($lists->THUMBNAIL_FILE));
                                                            $thumbnailarr = explode("|", $thumbnail);
                                                            ?>
                                                        @else
                                                            <?php $thumbnail = ""; ?>
                                                        @endif


                                                        <ul class="list_sum col-sm-12">
                                                        @foreach(@unserialize($lists->ATTACH_FILE) as $key => $filenames)

                                                            <li class="col-sm-4">
                                                                <a href="/{{$filenames}}" data-toggle="lightbox" data-title="등록전단지 {{$filenames}}" data-gallery="gallery" >
                                                                    @if($key == 0 && !empty($thumbnailarr[0]))
                                                                        <img src="/{{$thumbnailarr[0]}}" class="img-fluid mb-2" alt="red sample" width="100px;"/>
                                                                    @endif
                                                                    @if($key == 1 && !empty($thumbnailarr[1]))
                                                                        <img src="/{{$thumbnailarr[1]}}" class="img-fluid mb-2" alt="red sample" width="100px;"/>
                                                                    @endif
                                                                    @if($key == 2 && !empty($thumbnailarr[2]))
                                                                        <img src="/{{$thumbnailarr[2]}}" class="img-fluid mb-2" alt="red sample" width="100px;"/>
                                                                    @endif
                                                                </a>
                                                            <br/>
                                                            <?php
                                                                $fileSize = File::size(public_path($filenames));
                                                                $fileSize = floor($fileSize / 1024);
                                                                echo "Size: ".$fileSize."Kb";
                                                            ?>
                                                            <br/>

                                                            @if($key == 0 && !empty($realnamearr[0]))
                                                                {{$realnamearr[0]}}
                                                            @endif
                                                            @if($key == 1 && !empty($realnamearr[1]))
                                                                {{$realnamearr[1]}}
                                                            @endif
                                                            @if($key == 2 && !empty($realnamearr[2]))
                                                                {{$realnamearr[2]}}
                                                            @endif

                                                            </li>
                                                        @endforeach
                                                        <?php
                                                            unset( $thumbnailarr );
                                                            unset( $realnamearr );
                                                        ?>
                                                        </ul>
                                                    @endif

                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">상점서비스 상태</th>
                                                <th rowspan="1" colspan="1">상점명</th>
                                                <th rowspan="1" colspan="1">사업자번호</th>
                                                <th rowspan="1" colspan="1">대표자명</th>
                                                <th rowspan="1" colspan="1">담당자명</th>
                                                <th rowspan="1" colspan="1">업종</th>
                                                <th rowspan="1" colspan="1">업태</th>
                                                <th rowspan="1" colspan="1">주소</th>
                                                <th rowspan="1" colspan="1">전단지</th>
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


    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">신규 상점등록</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" id="quickForm" method="post" action="/storeList/write" enctype="multipart/form-data" novalidate="novalidate">
                    @csrf
                    <input type="text" name="store_id" value="0">
                    <input type="text" name="step" value="0">
                    <input type="text" name="attach_file" value="">

                    <input type="text" name="giftcheck" id="giftcheck" />
                    <input type="text" name="aptelecomcheck" id="aptelecomcheck" />
                    <input type="text" name="subscriptioncheck" id="subscriptioncheck" />
                    <input type="text" name="poscheck" id="poscheck" />

                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>상점상태</label>
                                        <select name="apcheck" id="apcheck" class="form-control">
                                            <option value="0">가입 신청</option>
                                            <option value="1">승인 완료</option>
                                            <option value="2">AP 설치</option>
                                            <option value="3">네트워크연동</option>
                                            <option value="4">철수</option>
                                            <option value="5">장비회수</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>상호명 <span style="color:red;">*</span></label>
                                        <input type="text" name="store_name" maxlength="30" class="form-control" placeholder="상점명">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>사업자번호 <span style="color:red;">*</span></label>
                                        <input type="number" name="ap_business" oninput="maxLengthCheck(this)"  class="form-control" placeholder="사업자번호" maxlength="10" placeholder="0000000000" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>업종 <span style="color:red;">*</span></label>
                                        <p style="display: flex; margin-bottom: 1rem;">
                                            <input type="number" name="ap_industry" id="industry" oninput="maxLengthCheck(this)" class="form-control col-sm-2" maxlength="6" placeholder="00000" style="width: 7em; margin-right: 1rem;">
                                            <button type="button" class="btn btn-info col-sm-4" onclick="codeopenPop()" >검색</button>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>업태</label>
                                        <input type="text" name="ap_instype" class="form-control col-sm-2" placeholder="업태" />
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>대표자 <span style="color:red;">*</span></label>
                                        <input type="text" name="ap_ceo" class="form-control"  placeholder="대표자">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>무선전화 <span style="color:red;">*</span></label>
                                        <input type="number" name="ap_ceomobile" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"   placeholder="무선전화">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>유선전화</label>
                                        <input type="number" name="ap_ceotelno" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"  placeholder="유선전화">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>담당자</label>
                                        <input type="text" name="ap_mgr" class="form-control"  placeholder="담당자">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>무선전화</label>
                                        <input type="number" name="ap_mgrmobile" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"  placeholder="무선전화">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>유선전화</label>
                                        <input type="number" name="ap_mgrtelno" oninput="maxLengthCheck(this)" maxlength="12" class="form-control"  placeholder="유선전화">
                                    </div>
                                </div>
                            </div>
                            <hr/>

                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label >주소 <span style="color:red;">*</span></label>
                                        <input type="text" name="postcode" id="postcode" class="form-control" placeholder="00000" >
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="addr" id="addr" class="form-control" placeholder="주소">
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="addr1" id="addr1" class="form-control" placeholder="주소">
                                    </div>
                                    <p style="text-align: right;">
                                        <button type="button" class="btn btn-info col-sm-4" onclick="sample6_execDaumPostcode()" >주소검색</button>
                                        (주소는 현재 사업장의 주소를 입력하셔야 합니다.)</p>
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
                                        <textarea name="storememo" id="storememo" class="form-control" rows="3" placeholder="기타 문의  ..."></textarea>
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
                                        <input type="text" name="ap_telecomother" class="form-control col-sm-2" placeholder="기타" />
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
                                        <input type="text" name="ap_ssid_id" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>AP 모델명 PW </label>
                                        <input type="text" name="ap_ssid_pw" class="form-control" />
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
                                        <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="1" ><span style="margin-left: 0.5rem; margin-right: 2rem; ">1 만원 ~ </span>
                                        <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="2" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">2 만원 ~ </span>
                                        <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="3" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">3 만원 ~ </span>
                                        <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="4" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">4 만원 ~ </span>
                                        <input type="radio" name="ap_comm_fee" id="ap_comm_fee" value="5" /><span style="margin-left: 0.5rem; margin-right: 2rem; ">5 만원 ~ </span>
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <span>
              	            <button type="button" class="btn btn-danger delBtn" style="display: none;"><i class="far fa-trash-alt"></i> Del</button>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@push('styles')
    <style>
        .list_sum  { list-style:none; }
        .list_sum li { float: left; }
    </style>
@endpush

@section('scripts')
    <script>

        function svcsearch(){

            if( $("#svcser option:selected").val() ){
                console.log($("#svcser option:selected").val());
                $("#selchval").val($("#svcser option:selected").val());
                $('#serchselect')[0].submit();
            }else{
                console.log('Null');
            }
        }


        $(document).ready(function () {

            $(document).on('click', '[data-toggle="modal"]', function(event) {
                <?php /*** 신규 상점 등록 */ ?>

                $('#quickForm').each(function() {
                    this.reset();
                });
                $('#quickForm')[0].reset();
                $(".modal-title").text("상점등록");
                $(".delBtn").hide();
                $('#quickForm')[0].action="/nwpromadd";
                event.preventDefault();
            });

            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });

            $('#example1').DataTable(
                {
                    "responsive": true,
                    "autoWidth": true,
                    "searching": true,
                    "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
                }
            );


            @if(Auth::user()->level == 10)

            var addtag = "<button type='button' class='btn btn-primary ' style='float:right;margin-left: 1rem;' onclick='svcsearch()'>조건검색</button> <select class='custom-select custom-select-sm form-control form-control-sm' id='svcser' style='width:120px; float:right; margin-left: 1rem;'>" +
                "<option value=''>선택</option><option value='all'>전체</option><option value='0'>가입신청</option><option value='1'>승인완료</option><option value='2'>AP설치</option><option value='3'>네트워크연동</option><option value='4'>철수</option><option value='5'>장비회수</option><option value='6'>가입해지</option>" +
                "</select> ";

            $("#example1_filter").append(addtag);

            @endif

            $(".delBtn").click(function() {
                if(confirm("정말 삭제하시겠습니까?")){
                    $('#quickForm')[0].action="/storeList/del";
                    $('#quickForm')[0].submit();
                }
            });


            $('#quickForm').validate({
                rules: {

                    store_name: { required: true },
                    ap_business: { required: true },
                    ap_industry: { required: true, minlength: 5 },
                    ap_ceo: { required: true },
                    ap_ceomobile: { required: true },
                    postcode: { required: true, number:true  },
                    addr: { required: true  }

                },
                messages: {
                    store_name: "상호명을 입력해 주세요",
                    ap_business: "사업자번호를 입력해 주세요",
                    ap_industry: "업종을 입력해 주세요",
                    ap_ceo: "대표자명을 입력해 주세요",
                    ap_ceomobile: "유선전화를 입력해 주세요",
                    postcode: "주소를 입력해 주세요",
                    addr: "주소를 입력해 주세요"
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


            $('#svcser').val('{{$reselnum}}').prop("selected",true);

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

            {{-- $('#quickForm')[0].submit(); --}}
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

    </script>

@endsection
