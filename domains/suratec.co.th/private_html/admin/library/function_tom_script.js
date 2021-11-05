


    function set_lang(val_lang){
        switch (val_lang) {
            case "th":
                console.log("th");
                document.cookie = "th";
                setCookie("lang" , "")
                break;
            case "en":
                console.log("en");
                document.cookie = "en";
                break;
            case "ch":
                console.log("th");
                document.cookie = "th";
                break;
            default:
                console.log("th_en");
                document.cookie = "th";
        }

    }


    function setCookie(key, value) {
        var expires = new Date();
        expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString()+"; ";
    }

    // $(document).ready(function(){$(document).on("click",".lang",function(n){var o=$(this).attr("data-id");setCookie("lang",o),location.reload()})});
    //
    // $( document ).ready(function() {
    //     $(document).on('click', '.lang', function(event) {
    //         var lang = $(this).attr('data-id');
    //         setCookie('lang',lang);
    //         location.reload();
    //     });
    // });



