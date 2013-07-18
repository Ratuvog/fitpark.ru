$(function () {
    // Check for the various File API support.
    var isFileAPI = false;
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        isFileAPI = true;
    }
    $(".fileinput-button input").on("change", function(){
        var imagefile = $(this)[0];
        var image = $(this).parents(".fileinput-button").first().find("img");
        // HTML5 FileAPI: Firefox 3.6+, Chrome 6+
        if(typeof(FileReader)!='undefined')
        {
            var reader = new FileReader();
            reader.onload = function(e){
                image.prop("src", e.target.result);
            }
            reader.readAsDataURL(imagefile.files.item(0));
        }
        // Firefox 3.0-3.6
        else if(imagefile.files && imagefile.files.item(0).getAsDataURL)
        {
            image.prop("src", imagefile.files.item(0).getAsDataURL());
        }
    })

    $("#submit").on("click",checkForm);
});