@extends('mails.layouts.main')
@section('title', 'Registration verification for churches')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a; text-align:center">Registration verification for churches</p>
<div >
	<p style="text-align: left;"> Hello {{ucfirst($name)}}, welcome to Kingdom!</p>
   
	<p style="text-align: left; color:#2d363a">Thank you for taking the time to register your Church with us and helping us vet businesses that are requesting to be on our platform. This allows us to ensure that we are only allowing Christian businesses onto Kingdom. By doing this we will constantly be transferring more wealth and dominion into Christian circles. </p>

    <p style="text-align: left; color:#2d363a">If you would like to see a video walk through with how to use <a style="color:#1D00EE" href="{{route('home')}}">kingdombusinesses.com</a> click on this link for a video tutorial.</p>

    <p style="text-align: left; color:#2d363a">If you ever have any questions feel free to reach out to us directly at <a style="color:#1D00EE;" href="mailto:{{env('SUPPORT_EMAIL')}}"> support@kingdombusinesses.com</a></p>

    <p style="text-align: left; color:#2d363a"> Or if you want to just jump in click on the button below</p>

    <p style="text-align: left; color:#2d363a"><a href="{{$verify_url}}">Click here</a> to verify your email </p>

    <p style="text-align: left; color:#2d363a">If you would like to know more about Kingdom and what Kingdom can do for your church click on this link</p>


    <p style="text-align: left;color: #2d363a61;font-size: small;">This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager and the sender, and delete this email and any attachments from your system.</p>
</div>
@endsection
