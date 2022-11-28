$("#edit_business_form").validate({
rules: {
    business_name:{
        required:true,
        noSpace:true,
    },
    business_email:{
        checkemail:true,
        required: true,
    },
    business_mobile_number:{
        required:true ,
        input_mask_mobile_number:true,
    },
    city:{
        required:true ,
        noSpace:true,
    },
    state:{
        required:true ,
        noSpace:true,
    },
    zip_code:{

        required:true ,
        minlength:5,
        maxlength:10,
    },
    description:{
        required:true ,
        noSpace:true,
    },
    sort_description:{
        required:true,
        noSpace:true,
    },
    business_category:{
        required:true,
    },
    address:{
        required:true,
        noSpace:true,
        validateAddress:true,
    },
    facebook_url:{
        checkurl:true,
    },
    twitter_url:{
        checkurl:true,
    },
    instagram_url:{
        checkurl:true,
    },
    linked_in_url:{
        checkurl:true,
    },
    website_url:{
        checkWebsiteUrl: true,
    },

},
messages: {
    business_name: 'Please enter business name',
    business_email:{
        required:"Please enter email",
        remote:"Email is already exists",
        checkemail:"Please enter valid email",
    },
    business_mobile_number: {
        required:'Please enter mobile number',
        input_mask_mobile_number:"Please enter a valid number",
    },
    city:"Please enter business city",
    state:"Please enter business state",
    zip_code:"Please enter zip code",
    description:"Please enter description",
    sort_description:"Please enter short description",
    address:{
       required:"Please enter address",
    },
    business_category:{
        required:"please choose category",
    },
    facebook_url: {
        checkurl:"Please enter valid facebook url",
    },
    instagram_url: {
        checkurl:"Please enter valid instagram url",
    },
    linked_in_url: {
        checkurl:"Please enter valid linkedin url",
    },
    twitter_url: {
        checkurl:"Please enter valid twitter url",
    },
    website_url: {
        url:"Please enter valid website url"
    },

},
errorPlacement: function(error, element) {
        var placement = $(element).data('error');
        if (placement) {
            $(placement).append(error)
        } else {
            error.insertAfter(element);
        }
    },
submitHandler: function (form) {
    return true;
},
success: function(label,element) {
    label.parent().removeClass('has-danger');
},
});
