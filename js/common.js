/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    /* Поиск по клубу    */
    var BLACK = "rgb(0, 0, 0)";
    $("#submit-search").click(function(){
        $(this).parents('form').submit();
    })
    $(".not-empty").focusin(function(){
        if($(this).css("color")!==BLACK)
            $(this).val("");
        $(this).css("color","black");
    })

    $(".not-empty").focusout(function(){
        if($(this).val()==="") {
            $(this).css("color","gray");
            $(this).val($(this).attr('place'));
        }
    })

    var nonEmptyText = $(".not-empty");
    nonEmptyText.val(nonEmptyText.attr('place'));
    nonEmptyText.css("color","gray");

    /* Валидация полей формы*/
    var validate = {
        email: {
            func: function(value){
                var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                return pattern.test(value);
            },
            errorPattern: function(fieldName){
                return "Поле '"+fieldName+"' имеет неверный формат";
            }
        },
        blank: {
            func: function(value){
                return value.length!=0;
            },
            errorPattern: function(fieldName) {
                return "Поле '"+fieldName+"' должно быть непустым";
            }
        },
        date: {
            func: function(value) {
                return true;
            },
            errorPattern: function(fieldName) {
                return "Поле '"+fieldName+"' имеет неверный формат";
            }
        },
        number: {
            func: function(value) {
                var pattern = new RegExp("/\d+/")
            },
            errorPattern: function(fieldValue) {
                return "Поле '"+fieldValue+"' должно содержать только цифры"
            }
        }
    };

    var checkForm = function(event) {
        var errorPull = [];
        var form = $(this).parents("form").first();
        form.find('input').each(function(){
            var validator = $(this).attr("validator");
            var textField = $(this).attr("text");
            if(!validate[validator].func($(this).val())) {
                $(this).css("border-color","red");
                errorPull.push(validate[validator].errorPattern(textField));
            }
        })
        if(errorPull.length === 0) {
            $('this').off("click", ".button-send");
            form.submit();
            return ;
        }
        form.find('.error-text').empty();
        form.find('.error-text').text("Некоторые поля заполнены с ошибками");
        errorPull = [];
    }

    $(".action-button").click(function(){
        var href = $(this).attr("href");
        var selectorForm = $(this).attr("selector");
        $(selectorForm+" form").attr("action", href);
        $(selectorForm+" form").on("click", ".button-send", checkForm);
        $.colorbox({
            href: selectorForm,
            inline: true
        });
    })
})

