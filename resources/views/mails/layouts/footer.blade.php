<div style="background-color: #2c373b; padding:10px 0px 10px 0px;">
    <img src="https://kingdombusinesses.com/img/LOGO1.png" width="160">
    <p style="text-transform: uppercase;margin-top:5px; margin-bottom:5px;">
        <a style="color: #fff;text-decoration:none;font-size: 10px;" href="{{route('home')}}">kingdombusinesses.com</a>
        <a style="color: #fff;text-decoration:none;font-size: 10px;" href="{{route('privacy.policy')}}"> | Privacy
            Policy</a>
        <a style="color: #fff;text-decoration:none;font-size: 10px;" href="mailto:{{env('SUPPORT_EMAIL')}}"> | Contact
            Support</a>
    </p>
    <p style="margin-top:5px; margin-bottom:5px;">
        <label style="color: #fff!important;text-decoration:none;font-size: 10px;">&copy; {{ date('Y') }} {{env('APP_NAME')}}
            Inc.</label>
    </p>
</div>
</div>
</body>

</html>
