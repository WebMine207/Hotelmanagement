@extends('mails.layouts.main')
@section('title', 'Registration verification for businesses')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a; text-align:center;">Registration verification for customers</p>
<div >
	<p style="text-align: left;">{{ucfirst($name)}} welcome to Kingdom!</p>

	<p style="text-align: left; color:#2d363a">We are excited to have you with us as we choose to be intentional with supporting Christian businesses! We are empowering one another to have greater Kingdom impact in the communities that we are living in.  </p>

    <p style="text-align: left; color:#2d363a"> If you would like to see a walk through with how to use <a style="color:#1D00EE" href="{{route('home')}}">kingdombusinesses.com</a> click on this link for a video tutorial.  </p>

    <p style="text-align: left; color:#2d363a"> Or if you want to just jump in click below</p>

    <p style="text-align: left; color:#2d363a"><a href="{{$verify_url}}">Click here</a> to verify your email and start browsing Christian businesses in your area! </p>

    <p style="text-align: left;color: #2d363a61;font-size: small;">This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager and the sender, and delete this email and any attachments from your system.</p>
</div>
@endsection
