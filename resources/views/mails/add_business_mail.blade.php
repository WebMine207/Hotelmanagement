@extends('mails.layouts.main')
@section('title', 'New Business Register')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a; text-align:center">New Business Register</p>
<div >
    <p>New business is register on the kingdom web. those business customer details is as per below </p>
	<div>Customer Details</div> 
	<p style="text-align: left; color:#2d363a">Name : {{$business_user_name}} </p>
    <p style="text-align: left; color:#2d363a">Email : {{$business_user_email}} </p>
	<p style="text-align: left; color:#2d363a">Mobile Number : {{$business_user_mobile_number}} </p>
    <p style="text-align: left; color:#2d363a">Leader/pastor Name : {{$church_leader_name}} </p>
    <p style="text-align: left; color:#2d363a">Leader/pastor email : {{$church_leader_email}} </p>
</div>
@endsection
