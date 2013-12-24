/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/* Класс для валидации полей формы */
validate = {
    email: {
        func: function(input) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test($(input).val());
        },
        errorPattern: function(input) {
            return "Поле '" + $(input).attr("text") + "' имеет неверный формат";
        }
    },
    blank: {
        func: function(input) {
            return $(input).val().length !== 0;
        },
        errorPattern: function(input) {
            return "Поле '" + $(input).attr("text") + "' должно быть заполнено";
        }
    },
    date: {
        func: function(input) {
            return true;
        },
        errorPattern: function(input) {
            return "Поле '" + $(input).attr("text") + "' имеет неверный формат";
        }
    },
    number: {
        func: function(input) {
            var pattern = new RegExp(/^[0-9]+\.{0,1}[0-9]{0,2}$/);
            return pattern.test($(input).val());
        },
        errorPattern: function(input) {
            return "Поле '" + $(input).attr("text") + "' должно содержать только цифры"

        }
    },
    empty: {
        func: function(input){
            return true;
        },
        errorPattern : ''
    },
    min_length: {
        func: function(input) {
            return ($(input).val().length >= $(input).attr("min-length"));
        },
        errorPattern: function(input) {
            return "Поле '" + $(input).attr("text") + "' должно содержать минимум " + $(input).attr("min-length") + " cимволов";
        }
    },
    match : {
        func: function(input) {
            var relInput = $.find("input[name=" + $(input).attr("match") + "]");
            return ($(input).val() === $(relInput).val());
        },
        errorPattern: function(input) {
            var relInput = $.find("input[name=" + $(input).attr("match") + "]");
            return "Поле '" + $(input).attr("text") + "' должно совпадать с полем " + $(relInput).attr('text');
        }

    }

};

/* метод, позволяющий осуществлять валидацию */

checkForm = function(event) {
    var errorPull = [];
    var form = $(this).parents("form").first();
    form.find('input,textarea').each(function()
    {
        var type = $(this).attr("type");
        $(this).css("border-color", "");

        if(type !== "hidden")
        {
            var validator = $(this).attr("validator") || "blank";
            var isRequire = $(this).attr("isReq") || "true";

            if ((isRequire !== "false") && !validate[validator].func($(this)) )
            {
                $(this).css("border-color", "red");
                errorPull.push(validate[validator].errorPattern($(this)));
            }
        }
    })
    if (errorPull.length === 0) {
        form.submit();
        return false;
    }
    
    for(var i = 0; i < errorPull.length; ++i)
    {
        var n = noty({
            layout: 'topRight',
            timeout: 5000,
            text : errorPull[i],
            type : 'info'
        });
    }
    errorPull = [];
    return false;
}