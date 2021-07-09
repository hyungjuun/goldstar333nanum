@extends('layouts.librenmsv1')

@section('title', __('나눔와이파이'))

@section('content')
    <link rel="shortcut icon" href="/images/splash.jpg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="http://210.116.101.13/css/splash.css">
    <link rel="stylesheet" href="http://210.116.101.13/css/resources/dist/css/adminlte.min.css">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-primary card-default" >
                    <br>
                    <div class="card-header">
                        <h3 class="card-title">나눔와이파이</h3>
                    </div>
                    <!-- /.card-header -->
                    <div id="step1" >
                        <!-- form start -->
                        <form class="form-horizontal">
                            <div class="card-body">
                                <div class="callout callout-danger">
                                    <h5>나눔 WiFi 서비스 사용을 위해 아래와 같이
                                        단말 정보를 수집, 이용합니다.</h5>
                                    <p>동의하지 않을 시 인터넷 사용 불가</p>
                                </div>
                                <ol>
                                    <li>개인정보(단말)수집 이용 목적 _ 나눔wifi 접속인증</li>
                                    <li>수집하는 개인정보 – 단말MAC Address</li>
                                    <li>개인정보 보유기간 - 개인정보보호법이 허용하는 범위내에서 나눔wifi 서비스 종료시 해당정보를 삭제</li>
                                    <li>WiFi 서비스 인증 업무 수행사 – ㈜금하</li>
                                </ol>
                            </div>

                            <div class="card-footer">
                                <button type="button" onclick="step2();" class="btn btn-primary float-right">동의합니다.</button>
                            </div>

                        </form>
                    </div>
                    <div id="step2" style="display:none">
                        <!-- form start -->
                        <form method="get" action="$authaction">
                            <input type="hidden" name="tok" value="$tok">
                            <input type="hidden" name="redir" value="$redir">
                            <div class="card-body">
                                <div class="form-group row">
                                    <!--label for="inputEmail3" class="col-sm-3 col-form-label">이름</label-->
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="이름">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!--label for="inputPassword3" class="col-sm-3 col-form-label">전화번호</label-->
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="inputPassword3" placeholder="전화번호">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!--label for="inputEmail3" class="col-sm-3 col-form-label">출생년도</label-->
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputAge" placeholder="연령대">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">성별</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select">
                                            <option>남</option>
                                            <option>여</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">지역</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select">
                                            <option>강원도</option>
                                            <option>경기도</option>
                                            <option>서울</option>
                                            <option>충청남도</option>
                                            <option>충청북도</option>
                                            <option>경상남도</option>
                                            <option>경상북도</option>
                                            <option>전라남도</option>
                                            <option>전라북도</option>
                                            <option>제주도</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-3 col-form-label">지역상세</label>
                                    <div class="col-sm-9">
                                        <select class="custom-select">
                                            <option>춘천시</option>
                                            <option>강릉시</option>
                                            <option>원주시</option>
                                            <option>속초시</option>
                                            <option>동해시</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" onclick="step1();" class="btn btn-default">가입취소</button>
                                <button type="submit" class="btn btn-primary float-right">나눔와이파이 가입</button>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                </div>

                </form>

                <hr>

                <copy-right>
                    Copyright &copy; NanumWiFi 2020.<br>
                </copy-right>
                <!-- /.card -->


            </div>


        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function step1(){

            document.getElementById("step1").style.display = "none"; // Hide
            document.getElementById("step2").style.display = "block"; // Show
        }
        function step2(){

            document.getElementById("step1").style.display = "none"; // Hide
            document.getElementById("step2").style.display = "block"; // Show
        }
    </script>
@endsection
