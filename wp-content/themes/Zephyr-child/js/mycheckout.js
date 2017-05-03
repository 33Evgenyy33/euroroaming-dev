// jQuery(document).ready(function ($) {
//     $('#billing_city').bind("input paste change keyup focusout", function () {
//         var $this = $(this),
//             val = $this.val();
//         val = val.substr(0, 1).toUpperCase() + val.substr(1);
//         $('#billing_city').val(val);
//     });
//
//     $(function () {
//         $("#billing_city").suggestions({
//             //addon: 'clear',
//             serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
//             token: "130f2a2c8d6f301798e11062b428edc776161e7e",
//             type: "ADDRESS",
//             count: 5,
//
//             onSelectNothing: function (query) {
//                 var $input = $(this);
//                 console.log('false');
//                 console.log(this);
//             },
//
//             onSelect: function (suggestion, changed) {
//                 if (suggestion.data.city != null) {
//                     $("#billing_city").val(suggestion.data.city + ' ' + suggestion.data.city_type);
//                     //$("#billing_address_2").val(suggestion.data.city_kladr_id);
//                 }
//
//                 if (suggestion.data.settlement_with_type != null)
//                     $("#billing_city").val(suggestion.data.settlement + ' ' + suggestion.data.settlement_type);
//
//                 $("#billing_address_1").val(function () {
//                     var summ = '';
//                     if (suggestion.data.street_with_type !== null) summ += suggestion.data.street_with_type + ', ';
//                     if (suggestion.data.house_type !== null) summ += suggestion.data.house_type + '. ';
//                     if (suggestion.data.house !== null) summ += suggestion.data.house;
//                     if (suggestion.data.block_type !== null) summ += ' ' + suggestion.data.block_type + '. ';
//                     if (suggestion.data.block !== null) summ += suggestion.data.block;
//                     return summ;
//                 });
//
//                 $("#billing_state").val(suggestion.data.region_with_type);
//                 $("#billing_city").change();
//                 $("#billing_state").change();
//                 $("#billing_address_1").suggestions({
//                     //addon: 'clear',
//                     serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
//                     token: "130f2a2c8d6f301798e11062b428edc776161e7e",
//                     type: "ADDRESS",
//                     geoLocation: {kladr_id: suggestion.data.kladr_id},
//                     count: 5,
//
//                     onSelectNothing: function (query) {
//                         console.log('false');
//                         console.log(this);
//                     },
//
//                     onSelect: function (suggestion, changed) {
//
//                         var summ = '';
//                         if (suggestion.data.street_with_type !== null) summ += suggestion.data.street_with_type + ', ';
//                         if (suggestion.data.house_type !== null) summ += suggestion.data.house_type + '. ';
//                         if (suggestion.data.house !== null) summ += suggestion.data.house;
//                         if (suggestion.data.block_type !== null) summ += ' ' + suggestion.data.block_type + '. ';
//                         if (suggestion.data.block !== null) summ += suggestion.data.block;
//
//                         $("#billing_address_1").val(summ);
//
//                         $("#billing_address_1").change();
//                         $("#billing_postcode").val(suggestion.data.postal_code);
//                         console.log(suggestion);
//                     }
//                 });
//
//                 console.log('true');
//                 console.log(suggestion);
//             }
//         });
//
//         $("#billing_address_1").suggestions({
//             //addon: 'clear',
//             serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
//             token: "130f2a2c8d6f301798e11062b428edc776161e7e",
//             type: "ADDRESS",
//             count: 5,
//
//             onSelectNothing: function (query) {
//                 console.log('false');
//                 console.log(this);
//             },
//
//             onSelect: function (suggestion, changed) {
//                 var summ = '';
//                 if (suggestion.data.street_with_type !== null) summ += suggestion.data.street_with_type + ', ';
//                 if (suggestion.data.house_type !== null) summ += suggestion.data.house_type + '. ';
//                 if (suggestion.data.house !== null) summ += suggestion.data.house;
//                 if (suggestion.data.block_type !== null) summ += ' ' + suggestion.data.block_type + '. ';
//                 if (suggestion.data.block !== null) summ += suggestion.data.block;
//
//                 $("#billing_address_1").val(summ);
//                 console.log(suggestion);
//             }
//         });
//     });
// });

////////////////////////////////////////////////////////////////////////////////////

// jQuery(document).ready(function ($) {
//     $(".closed").toggleClass("show");
//
//     $(".title").click(function () {
//         $(this).parent().toggleClass("show").children("div.contents").slideToggle("medium");
//         if ($(this).parent().hasClass("show"))
//             $(this).children(".title_h3").css("background", "rgb(253, 253, 253)");
//         else $(this).children(".title_h3").css("background", "rgb(240, 238, 238)");
//     });
// });
//
// function join(arr /*, separator */) {
//     var separator = arguments.length > 1 ? arguments[1] : ", ";
//     return arr.filter(function (n) {
//         return n
//     }).join(separator);
// }
//
// jQuery(document).ready(function ($) {
//
//     $("#fullname").suggestions({
//         serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
//         token: "073d0c16cff95d04816baff3eaf42d4adefba5f9",
//         type: "NAME",
//         /* Вызывается, когда пользователь выбирает одну из подсказок */
//         onSelect: function (suggestion) {
//             console.log(suggestion);
//             var fullname = suggestion.data;
//
//             $("#billing_first_name").val(fullname.name);
//             $("#billing_last_name").val(fullname.surname);
//
//         }
//     });
//
//
//     $("#address").suggestions({
//         serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
//         token: "073d0c16cff95d04816baff3eaf42d4adefba5f9",
//         type: "ADDRESS",
//         /* Вызывается, когда пользователь выбирает одну из подсказок */
//         onSelect: function (suggestion) {
//             console.log(suggestion);
//             var address = suggestion.data;
//             $("#billing_postcode").val(address.postal_code);
//             $("#billing_state").val(suggestion.data.region_with_type);
//             $("#billing_state").change();
//             $("#billing_city").val(join([
//                 //join([address.area_type, address.area], " "),
//                 join([address.city, address.city_type], " "),
//                 join([address.settlement_type, address.settlement], " ")
//             ]));
//             $("#billing_city").change();
//             $("#billing_address_1").val(join([
//                 join([address.street_type, address.street], " "),
//                 join([address.house_type, address.house], " "),
//                 join([address.block_type, address.block], " "),
//                 join([address.flat_type, address.flat], " ")
//             ]));
//
//         }
//     });
//
//     $("#email").suggestions({
//         serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
//         token: "073d0c16cff95d04816baff3eaf42d4adefba5f9",
//         type: "EMAIL",
//         /* Вызывается, когда пользователь выбирает одну из подсказок */
//         onSelect: function (suggestion) {
//             console.log(suggestion);
//             var email = suggestion.data;
//             $("#billing_email").val(email.local + "@" + email.domain);
//         }
//     });
//
// });

/*document.getElementById('phone').addEventListener('input', function (e) {
 document.getElementById('billing_phone').value = this.value;
 });*/

////////////////////////////////////////////////////////////////

/*jQuery(document).ready(function ($) {
 $(".closed").toggleClass("show");

 $(".title").click(function () {
 $(this).parent().toggleClass("show").children("div.contents").slideToggle("medium");
 if ($(this).parent().hasClass("show"))
 $(this).children(".title_h3").css("background", "rgb(253, 253, 253)");
 else $(this).children(".title_h3").css("background", "rgb(240, 238, 238)");
 });
 });*/

function join(arr /*, separator */) {
    var separator = arguments.length > 1 ? arguments[1] : ", ";
    return arr.filter(function (n) {
        return n
    }).join(separator);
}

jQuery(document).ready(function ($) {

    $("#billing_first_name").suggestions({
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "94efab2e13b37cf6fe0d782a4c3f685ca2bf7627",
        type: "NAME",
        params: {
            parts: ["NAME"]
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            // Делаем что-то
        }
    });

    $("#billing_last_name").suggestions({
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "94efab2e13b37cf6fe0d782a4c3f685ca2bf7627",
        type: "NAME",
        params: {
            parts: ["SURNAME"]
        },
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            // Делаем что-то
        }
    });

    $("#billing_email").suggestions({
        serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
        token: "94efab2e13b37cf6fe0d782a4c3f685ca2bf7627",
        type: "EMAIL",
        /* Вызывается, когда пользователь выбирает одну из подсказок */
        onSelect: function (suggestion) {
            // Делаем что-то
        }
    });

    var $city = $("#billing_city"), $street = $("#billing_address_1");

    $city.keydown(function(){
        $("#billing_address_2").val('');
    });

    /*, $country = $("span#select2-chosen-1");*/


    $city.bind("focus", function () {

        //console.log($("span#select2-chosen-1").text());

        if ($("#s2id_billing_country #select2-chosen-1").text() != 'Россия') {
            $city.suggestions().disable();
            return;
        }

        $city.suggestions({
            serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
            token: "94efab2e13b37cf6fe0d782a4c3f685ca2bf7627",
            type: "ADDRESS",
            hint: false,
            bounds: "city-settlement",
            count: 5,
            /* Вызывается, когда пользователь выбирает одну из подсказок */

            onSelectNothing: function (query) {
                $city.val('');
            },

            onSelect: function (suggestion) {
                console.log(suggestion);
                var address = suggestion.data;
                switch (address.fias_level) {
                    case "4":
                        $city.val(join([
                            join([address.city, address.city_type], " "),
                        ]));
                        break;
                    case "6":
                        $city.val(join([
                            join([address.settlement, address.settlement_type], " ")
                        ]));
                        break;
                }
                $("#billing_state").val(address.region_with_type);
                if (address.fias_level === '4'){
                    console.log('city');
                    $("#billing_address_2").val(address.city_fias_id);
                } else if  (address.fias_level === '6') {
                    console.log('settlement');
                    $("#billing_address_2").val(address.settlement_fias_id);
                }
                $("#billing_state").change();
                $("#billing_city").change();
            }
        });

    });

    // $street.bind("focus", function () {
    //
    //     //console.log($("span#select2-chosen-1").text());
    //
    //     if ($("span#select2-chosen-1").text() != 'Россия') {
    //         $street.suggestions().disable();
    //         return;
    //     }
    //
    //     $street.suggestions({
    //         serviceUrl: "https://suggestions.dadata.ru/suggestions/api/4_1/rs",
    //         token: "130f2a2c8d6f301798e11062b428edc776161e7e",
    //         type: "ADDRESS",
    //         hint: false,
    //         bounds: ["street", "house"],
    //         constraints: $city,
    //         /* Вызывается, когда пользователь выбирает одну из подсказок */
    //         onSelect: function (suggestion) {
    //             var address = suggestion.data;
    //             $street.val(join([
    //                 join([address.street_type, address.street], " "),
    //                 join([address.house_type, address.house], " "),
    //                 join([address.block_type, address.block], " "),
    //                 join([address.flat_type, address.flat], " ")
    //             ]));
    //             $("#billing_postcode").val(address.postal_code);
    //
    //         }
    //     });
    //
    // });


});