// dropzoneWordpressForm is the configuration for the element that has an id attribute
// with the value dropzone-wordpress-form (or dropzoneWordpressForm)
var currentFile = null;
var intro;

Dropzone.options.dropzoneWordpressForm = {
    //acceptedFiles: "image/*", // all image mime types
    acceptedFiles: ".jpg, .png, .pdf, .doc, .docx", // only .jpg files
    // maxFiles: 1,
    uploadMultiple: true,
    maxFilesize: 5, // 5 MB
    parallelUploads: 1,
    addRemoveLinks: true,
    dictRemoveFile: 'Удалить файл',
    dictCancelUpload: 'Отменить загрузку',
    successmultiple: function (file, response) {
        //console.log(response);
        //fileList.push(String(response));
        fileList.push({"serverFileName": response, "fileName": file[0].name});
        //console.log(fileList);
        jQuery(document).ready(function ($) {

            var result = [];
            $.each(fileList, function (k, v) {
                result.push(v.serverFileName)
            });

            CUSTOMER.additional_fields['uploaded_files'] = result.join();
            CART.calculate_totals();
            console.log(result);
            console.log(CUSTOMER);
        });
    },
    init: function () {
        this.on("sending", function (file, xhr, formData) {
            formData.append("name", "value"); // Append all the additional input data of your form here!
        });
    },
    removedfile: function (file) {
        //console.log(file);
        if (!order_is_created) {
            jQuery(document).ready(function ($) {

                if (fileList.length === 1)
                    $('#dropzone-wordpress-form .needsclick').addClass('hide_needsclick');

                swal({
                    title: 'Удалить загруженный файл?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Да, удалить',
                    cancelButtonText: 'Отмена'
                }).then(function () {

                    var data = '';
                    $.each(fileList, function (index, element) {
                        if (element.fileName === file.name) {

                            fileList.splice(index, 1);

                            var jsonString = element.serverFileName.replace('http://euroroaming/wp-content/uploads/passports-from-tourist/', '');

                            data = {
                                action: 'remove_dropzonejs_file',
                                whatever: jsonString
                            };
                            jQuery.post(ajaxurl, data, function (response) {
                                swal(
                                    'Удалено!',
                                    'Выбранный фал был удален.',
                                    'success'
                                );
                                var result = [];
                                $.each(fileList, function (k, v) {
                                    result.push(v.serverFileName)
                                });
                                CUSTOMER.additional_fields['uploaded_files'] = result.join();
                                CART.calculate_totals();
                                console.log(response);
                                console.log(CUSTOMER);
                            });

                            if (fileList.length === 0) {
                                $('#dropzone-wordpress-form .needsclick').removeClass('hide_needsclick');
                            }

                            var _ref;
                            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                        }
                    });

                });

            });
        } else {
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        }

    }
    /*removedfile: function (file) {

     return (_ref = file.previewElement) != null ? ref.parentNode.removeChild(file.previewElement) : void 0;

     }*/
};

function startIntro(){
    intro = introJs();
    intro.setOptions({
        steps: [
            {
                intro: "<h3 style='text-align: center;font-weight: 400;'>Добро пожаловать в кабиент продаж!</h3>" +
                "<p style='text-align: center;font-weight: 300;'>Чтобы начать ознакомление нажмите кнопку <span style='text-align: center;font-weight: 500;'>'Вперед'</span></p>"
            },
            {
                element: document.querySelector('#wc-pos-register-grids .tbc'),
                intro: "<h3 style='text-align: center;font-weight: 400;'>Блок <strong>Сим-карты</strong></h3>" +
                "<p style='text-align: center;font-weight: 300;'>Здесь Вы можете добавлять сим-карты в заказ.</p>" +
                "<p style='text-align: center;font-weight: 300;'>После нажатия на картинку с сим-карой появляется окно, где необходимо выбрать опции сим-карты</p>",
                position: 'auto'
            },
            {
                element: document.querySelector('#bill_screen'),
                intro: "<h3 style='text-align: center;font-weight: 400;'>Блок <strong>Детали заказа</strong></h3>" +
                "<p style='text-align: center;font-weight: 300;'>Здесь Вы можете просмотреть информацию о добавленных сим-картах, а также конечную сумму заказа для Вас и для Клиента</p>",
                position: 'right'
            },
            {
                element: document.querySelector('#register_customer_dates'),
                intro: "<h3 style='text-align: center;font-weight: 400;'>Блок <strong>Детали клиента</strong></h3>" +
                "<p style='text-align: center;font-weight: 300;'>Здесь Вы можете добавить информацию о клиенте</p>",
                position: 'right'
            },
            {
                element: document.querySelector('#dropzone-wordpress'),
                intro: "<h3 style='text-align: center;font-weight: 400;'>Элемент <strong>Загрузка документов</strong></h3>" +
                "<p style='text-align: center;font-weight: 300;'>Здесь Вы можете загрузить загранпаспорт(а) клиента.</p>" +
                "<p style='text-align: center;font-weight: 300;'>Чтобы загрузить документ перетащите его в эту область или нажмите на нее.</p>" +
                "<p style='text-align: center;font-weight: 300;'>Доступные форматы: <strong>jpg, png, pdf, word</strong></p>",
                position: 'right'
            },
            {
                element: '#step5',
                intro: 'Get it, use it.'
            }
        ],
        disableInteraction: true,
        prevLabel: 'назад',
        nextLabel: 'вперед',
        skipLabel: 'выйти',
        showProgress: true,
        showStepNumbers:false,
        doneLabel: 'Начать продавать!'
    });

    intro.onexit(function() {
        intro = null;
    });

    intro.start();
}

/*intro.oncomplete(function() {

});*/


jQuery(document).ready(function ($) {

    /*$("#wc-pos-register-grids #grid_layout_cycle").click(function(){
        console.log('stepppsss');
        intro.goToStep(3).start();
    });*/

    /*$(".wc_pos_register_pay").click(function(){
        console.log('stepppsss');
        intro.goToStep(4).start();
    });*/

    $("#start_tour").click(function(){
        startIntro();
    });
});