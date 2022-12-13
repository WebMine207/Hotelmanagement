$('#addHotelForm').parsley();

/**
 * Function for the show preview images
 */
 var previewImages = function (input) {
    if (input.files) {
        var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                var id = i++;
                $('.images-previews').append('<div class="col pic_'+id+'_delete"><div class="position-relative"><img width="30%" src="'+ event.target.result+'"><a class="btn btn-sm remove_image" image_id='+id+'><i class="bi bi-x-lg"></i></a></div>');
            }
            reader.readAsDataURL(input.files[i]);
        }
    }
};

$("#images").on("change", function (evt) {
    previewImages(this);
});

// ('#feature_image').on("change", function (evt) {
$("#feature_image").on("change", function (evt) {
    filePreview(this,'#images-preview');
});

function filePreview(input,imgPreviewPlace) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(event) {
            $('.preview-image').removeClass('bi bi-camera text-blue text-2xl');
            $('.my-image-preview').remove();
            $($.parseHTML('<img class="my-image-preview" width="30%" height="30%">')).attr('src', event.target.result).appendTo(imgPreviewPlace);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

/**
 * Function for the delete preview images
 */
    $(document).on('click', '.remove_image',function () {
    var id = $(this).attr('image_id');
    var className = 'pic_'+id+'_delete';
    $('.'+className).remove();
});