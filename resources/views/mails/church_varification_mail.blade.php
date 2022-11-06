@extends('mails.layouts.main')
@section('title', 'Registration Verification for churches')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a; text-align:center;">Verify {{env('APP_NAME')}} Account</p>
<div >
    <p style="text-align: left;">Hello {{ucfirst($name)}},</p>

    <p style="text-align: left; color:#2d363a; margin-top:5px;">{{$business_user_name}} a member of {{ucfirst($church_name)}}, is requesting to be added to Kingdom. Kingdom is an online directory of Christian businesses. In order to ensure that we are only allowing Christian businesses onto the platform our members need to go through a preapproval process. They have to agree to our <a style="color:#1D00EE" href="{{route('statement-of-faith')}}"> statement of faith </a>  and our <a style="color:#1D00EE" href="{{route('membership-requirement')}}"> Membership Requirement</a>. Once they have done this we require that their pastor or spiritual leader from their church would also confirm their Christian walk of life.</p>

    <p style="text-align: left; color:#2d363a; margin-top:5px;">If you have not received a previous email from us regarding {{$business_user_name}} and their business verification request it must have gotten lost along the way and we apologize for that. Please  <a style="color:#1D00EE" href="{{route('aboutus')}}">click here </a> to learn more about Kingdom and how Kingdom is helping Church members across the nation. If you want to just verify you church information provided to us by {{$business_user_name}} that is as per below.</p>

    <p style="text-align: left; color:#2d363a; margin-top:5px;">Here are {{$business_user_name}}’s Business Details : </p>
    <p style="text-align: left; color:#2d363a">Business Name : {{$business_user_name}} </p>
    <p style="text-align: left; color:#2d363a">Business Email : {{$business_user_email}} </p>
    <p style="text-align: left; color:#2d363a">Business Mobile Number : {{$business_user_mobile_number}} </p>

    <p style="text-align: left; color:#2d363a"> To the best of your knowledge can you confirm the following questions.</p>

    <p style="text-align: left; color:#2d363a"> 1. Does {{$business_user_name}} attend {{ucfirst($church_name)}} on a regular basis?<br>
    2. These are our <a style="color:#1D00EE" href="{{route('membership-requirement')}}"> Membership Guidelines</a>. To the best of your knowledge would you agree that {{$business_user_name}} is striving to keep our membership requirements?</p>

    <p style="text-align: left; color:#2d363a">Kingdom is partnering with Churches to help their church members. If you have not yet seen Pastor Mike Lotzer interview Tim Kopylov, the founder of Kingdom <a>click on this link </a>  . In this short video Tim goes over what Kingdom is and what it is doing for Churches across the nation. </p>

    <p style="text-align: left; color:#2d363a">Most Pastors already have a desire to have their members support each other’s businesses within their church. But many lack the resources to make this easily accessible to their members. Kingdom does this for your Church. Through Kingdom your members can locate businesses that are within your church and reach out to them for a quote.</p>

    <p style="text-align: left; color:#2d363a">Also as an organization we believe in tithing beyond ten percent. Not only do we use our profits to advance God’s kingdom around the world but in addition, ten percent of membership fees go back to the church where they are attending. That means another stream of income for your church.</p>

    If your church doesn’t have a church directory and you would like one we also make these for free regardless if the church is a member of Kingdom.

    Here at Kingdom we are creating networks where we can work together to advance God’s Kingdom in your communities. If you would like to know more about Kingdom. click on the <a href="{{route('aboutus')}}">link</a>.
    <br><br>
    <a style="color:#1D00EE" href="{{$verify_url}}">Click here </a> to either approve or reject {{$business_user_name}} business account.

    <p style="text-align: left;color: #2d363a61;font-size: small;">This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error, please notify the system manager and the sender, and delete this email and any attachments from your system.</p>

</div>
@endsection
