
    var id='{{$users->id}}';

        $("#edit_users_form").validate({
        rules: {
            first_name: {
                required:true ,
                noSpace:true,
            },
            last_name: {
                required:true ,
                noSpace:true,
            },
            country_code:{
                required:true ,
            },
            username:{
                required:true,
                noSpace:true,
                minlength:3,
                remote:{
                    type: 'post',
                    url: "{{route('backend.user.username_exists')}}",
                    data: {'_token': $("input[name=_token]").val(),id:id},
                    dataFilter: function (data)
                    {
                        console.log(data);
                        var json = JSON.parse(data);
                        if (json.valid === true) {
                            return '"true"';
                        } else {
                            return "\"" + json.message + "\"";
                        }
                    }
                }
            },
            email: {
                checkemail:true,
				required: true,
				remote: {
							type: 'post',
							url: "{{route('backend.user.email_exists')}}",
							data: {'_token': $("input[name=_token]").val(),id:id},
							dataFilter: function (data)
							{
                                console.log(data);
								var json = JSON.parse(data);
								if (json.valid === true) {
                                    return '"true"';
								} else {
                                    return "\"" + json.message + "\"";
								}
							}
                        }

					},
            mobile_number: {
                required:true ,
                input_mask_mobile_number:true,
            },
        },
        messages: {
            first_name: 'Please enter first name',
            last_name: 'Please enter last name',
            username:{
                required:'Please enter your user name',
            },
            email:{
                required:"Please enter email",
                remote:"Email is already exists",
                checkemail:"Please enter valid email",
            },
            mobile_number: {
                required:"Please enter mobile number",
                input_mask_mobile_number:"Please enter a valid number",
            },
            country_code:{
                required:"Please choose any country code",
            }
        },
        submitHandler: function (form) {

            return true;
        },
        success: function(label,element) {
            label.parent().removeClass('has-danger');
        },
    });
