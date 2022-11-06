@extends('mails.layouts.main')
@section('title', 'Complete Church Registration')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a; text-align:center;">Church Registration</p>
<div >
	<p style="text-align: left;">Hello {{ucfirst($name)}},</p>

     <p style="text-align: left; color:#2d363a">{{$business_user_name}} a member of {{$church_name}} is requesting to add {{$church_name}} to our online platform at <a style="color:#1D00EE" href="{{route('home')}}">kingdombusinesses.com</a>. {{$business_user_name}} listed you as a leader at {{$church_name}}. You should have gotten another email with a request to verify {{$business_user_name}}”s account so that their business can be activated on our online platform. I would suggest that you read that email first before continuing with this email. </p>


     <p style="text-align: left; color:#2d363a; font-style: italic;font-size: small;">If you have not received a previous email from us regarding {{$business_user_name}} and their business {{$business_user_name}}  click on the <a href="{{route('aboutus')}}">link</a> to learn more about Kingdom and how Kingdom is helping Churches across the nation.</p>

    <p style="text-align: left; color:#2d363a">Please follow the link below to confirm your Churches details below and create your churches online account with Kingdom. This way you will see other Business owners that are signed up from your church and the verification process will be much quicker next time another business requests to sign up.
    </p>

    <p>Below are the details that {{$business_user_name}} entered for {{$church_name}} </p>
    
    <p style="text-align: left; color:#2d363a"> Church Name : {{ $church_name }} </p>
    <p style="text-align: left; color:#2d363a">Church email : {{ $church_email }} </p>
    <p style="text-align: left; color:#2d363a">Name of leader/pastor : {{ $name }} </p>
    <p style="text-align: left; color:#2d363a">Email of leader/pastor: {{ $email_to }}</p>
    
    <a style="color:#1D00EE" href="{{$registration_url}}">Click on this link </a> to complete your free online account with Kingdom.
    </div>
@endsection

