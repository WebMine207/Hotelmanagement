@extends('mails.layouts.main')
@section('title', 'Registration verification for your business')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a; text-align:center;">Registration verification for business</p>
<div >
	<p style="text-align: left;">{{ucfirst($name)}} welcome to Kingdom!</p>
	<p style="text-align: left; color:#2d363a">We are excited to have you with us as we embark on changing the Christian economy around the world! We are empowering one another to have greater Kingdom impact in the communities that we are living in. </p>
	<p style="text-align: left; color:#2d363a">Here is what you can expect from the sign up process. </p>

    <p style="text-align: left; color:#2d363a">We will ask you to fill in your basic business information as well as which church you regularly attend. We will also ask for your pastor's name and email address (this can be a pastor, elder, church official, small group leader, etc). We will send them an email to verify that you are attending the church you mentioned on a regular basis. This vetting process helps us to ensure that we are allowing only Christian businesses onto Kingdom.</p>

    <p style="text-align: left; color:#2d363a"> You will complete the sign up process with an electronic signature where your business member portal will be activated. </p>

    <p style="text-align: left; color:#2d363a">This portal will allow you to import your photos and create a bio of your business. If you would like to see a walk through video with how to set up your business profile click on <a> this link </a> .</p>

    <p style="text-align: left; color:#2d363a">Other than that if you ever have any questions feel free to reach out to us directly at<a  style="color:#1D00EE" href="mailto:{{env('SUPPORT_EMAIL')}}"> support@kingdombusinesses.com</a></p>

    <p style="text-align: left; color:#2d363a">Ready to start? </p>

    <p style="text-align: left; color:#2d363a"><a href="{{$verify_url}}">Click here</a> to verify your email and continue your sign up process</p>

    <p style="text-align: left;color: #2d363a61;font-size: small;">This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager and the sender, and delete this email and any attachments from your system.</p>
</div>
@endsection
