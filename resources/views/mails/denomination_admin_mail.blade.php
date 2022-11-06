@extends('mails.layouts.main')
@section('title', 'New Denomination')
@section('content')
<p style="font-size: 18px;font-weight: 500; color:#2d363a; text-align:center">New Denomination</p>
<div >
    
    <div>New Denomination : {{$new_denomination}} </div>

    <p>New denomination is added on the kingdom. that denomination details is as per above. please check & approve it if it's approvable.</p>

</div>
@endsection
