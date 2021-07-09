@extends('layouts.librenmsv1')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('auth.login-form')
            <p><button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='signup'">회원가입신청</button></p>
        </div>

{{--        <br/>--}}
{{--        <div class="col-md-6 col-md-offset-3">--}}
{{--            <div class="panel panel-body ">--}}
{{--            <hr/>--}}
{{--            <p>회사명 (서비스 회사명) : 주관사 (주)골드스타 333 </p>--}}
{{--            <p>주  소 : 강원도 화천군 사내면 수피령로 10번지</p>--}}
{{--            <p>관리자명 : 김대준</p>--}}
{{--            <p>전화번호/E-mail : </p>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
@endsection

@push('styles')
<style>
    HTML {
        height: 100%;
    }
    .row { margin-top: 15rem; }
    BODY {
        min-height: 100%;
        background-image: url("/images/bg_login.jpg");
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
@endpush
