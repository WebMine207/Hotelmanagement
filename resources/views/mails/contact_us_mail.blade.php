@extends('mails.layouts.main')
@section('title', 'Contact Inquiry')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a; text-align:center;">Contact Inquiry</p>
<div >
	<p style="text-align: left;">Hi {{ucfirst($name)}},</p>

	<p style="text-align: left; color:#2d363a">Congratulations you have an inquiry request from a potential customer. We recommend that you contact them as soon as possible! God’s grace and favor upon you and your business.</p>
	<p style="text-align: left; color:#2d363a">Name : {{$customer_name}} </p>
    <p style="text-align: left; color:#2d363a">Email : {{$customer_email}} </p>
	<p style="text-align: left; color:#2d363a">Mobile Number : {{$customer_mobile_number}} </p>
    <p style="text-align: left; color:#2d363a">Description : {{$customer_description}} </p>
</div>
@endsection
