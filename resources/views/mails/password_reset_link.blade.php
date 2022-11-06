@extends('mails.layouts.main')
@section('title', 'Password Reset Link')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a; text-align:center;">Password Reset Link {{env('APP_NAME')}} Account</p>
<div >
	<p style="text-align: left;">Hello {{ucfirst($name)}},</p>
	<p style="text-align: left; color:#2d363a"> You are receiving this email because we received a password reset request for your account.</p>

    <p style="margin-top:30px; margin-bottom:0px;text-align:center">
		<a href="{{$reset_link}}" style="background-color: #47a4e6; color: #fff;padding: 10px 30px; text-decoration: none;border-radius: 6px;display: inline-block;margin-top: 20px;">Reset Password</a>
	</p>

    <p style="text-align: left; color:#2d363a">If you did not request a password reset, no further action is required.</p>

</div>
@endsection

