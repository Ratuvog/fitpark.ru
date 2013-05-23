/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


/* Класс для валидации полей формы */
validate = {
    email: {
        func: function(value) {
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(value);
        },
        errorPattern: function(fieldName) {
            return "Поле '" + fieldName + "' имеет неверный формат";
        }
    },
    blank: {
        func: function(value) {
            return value.length != 0;
        },
        errorPattern: function(fieldName) {
            return "Поле '" + fieldName + "' должно быть непустым";
        }
    },
    date: {
        func: function(value) {
            return true;
        },
        errorPattern: function(fieldName) {
            return "Поле '" + fieldName + "' имеет неверный формат";
        }
    },
    number: {
        func: function(value) {
            var pattern = new RegExp("/\d+/")
        },
        errorPattern: function(fieldValue) {
            return "Поле '" + fieldValue + "' должно содержать только цифры"
        }
    }
};

/* метод, позволяющий осуществлять валидацию */

checkForm = function(event) {
    var errorPull = [];
    var form = $(this).parents("form").first();
    form.find('input,textarea').each(function() {
        var validator = $(this).attr("validator");
        var textField = $(this).attr("text");
        var isRequire = $(this).attr("isReq");
        if (!validate[validator].func($(this).val()) && (isRequire !== "false")) {
            $(this).css("border-color", "red");
            errorPull.push(validate[validator].errorPattern(textField));
        }
    })
    if (errorPull.length === 0) {
        form.submit();
        return;
    }
    form.find('.error-text').empty();
    form.find('.error-text').text("Некоторые поля заполнены с ошибками");
    errorPull = [];
}