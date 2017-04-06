// dropzoneWordpressForm is the configuration for the element that has an id attribute
// with the value dropzone-wordpress-form (or dropzoneWordpressForm)
Dropzone.options.dropzoneWordpressForm = {
    //acceptedFiles: "image/*", // all image mime types
    acceptedFiles: ".jpg", // only .jpg files
    maxFiles: 1,
    uploadMultiple: false,
    maxFilesize: 5, // 5 MB
    //addRemoveLinks: true,
    //dictRemoveFile: 'X (remove)',
    init: function() {
        this.on("sending", function(file, xhr, formData) {
            formData.append("name", "value"); // Append all the additional input data of your form here!
        });
    }
};