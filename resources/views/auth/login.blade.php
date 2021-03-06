@extends('layouts.librenmsv1')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @include('auth.login-form')
            <p><button type="button" class="btn btn-block btn-primary btn-lg" onclick="location.href='signup'">회원가입신청</button></p>
        </div>
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
