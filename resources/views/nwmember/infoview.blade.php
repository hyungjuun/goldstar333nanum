@extends('layouts.librenmsv1')

@section('title', __('나눔와이파이 회원가입 결과'))

@section('content')
    <div class="container-fluid">
        <div class="row pagerow" >
            <div class="col-md-6 col-xs-12 pagerow_conbg" >
                <h1>회원가입 신청이 완료되었습니다.</h1>
                <div class="messageinfo">

                @if($infomessage == "Yes")
                    <h3>신청이 완료 되었습니다.</h3>
                @endif

                @if($infomessage == "No")
                    <h3>신청 접수에 오류가 있습니다. <br/> 관리자에게 문의 바랍니다.</h3>
                @endif
                    <p class="csinfo">문의 : 1111@gmail.com TEL : 0000-0000</p>

                </div>
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
            min-height: 100%;
            /*background-image: url("https://cdn.pixabay.com/photo/2017/02/08/17/24/fantasy-2049567_960_720.jpg");*/
            background-image: url("/images/bg_login.jpg");
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        /*.pagerow { background-color: #8c8c8c; padding: 2rem 1rem 4rem 1rem; min-height: 400px; }*/
        .pagerow h1 {text-align: center; color: gray; padding: 2rem; }
        .pagerow h3 {text-align: center; color: gray; padding: 2rem;}
        .pagerow_conbg { float: none; margin: 0 auto; background-color: #fff; border-radius: 1rem; padding: 3rem;   }
        .messageinfo { border-top: 1px solid #eeeeee; }
        .messageinfo p { text-align : center; }
        .csinfo { margin-top: 3rem; margin-bottom: 2rem; }
    </style>
@endpush
