@extends('frontend.layouts.email')


@section('content')
    <h1>Xác thực tài khoản</h1>
  <p>Vui lòng click

    <a href="{{ route('frontend.signup.active', ['id'=>$user->id,'code'=>$user->email_verification_code]) }}">vào đây</a>

      để xác thực tài khoản của bạn</p>
@endsection
