/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    /* Поиск по клубу    */
    $("#submit-search").click(function(){
        var href = "http://"+location.host+'/clubs/search/'+$("#search").val();
        window.location.href = href;
    })

    /* Валидация полей формы*/
    var validate = {
        email: function(value){
            var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
            return pattern.test(value);
        },
        blank: function(value){
            return value.length!=0;
        },
        date: function(value){
            return true;
        }
    };


    $("#window-checkout .button-send").click(function(){
        var errorPull = [];
        var nameField    = $('#window-checkout input[name="name"]');
        var emailField   = $('#window-checkout input[name="e-mail"]');
        var telefonField = $('#window-checkout input[name="tel"]');
        if(!validate.blank(nameField.val())) {
            nameField.css("border-color", "red");
            errorPull.push('Поле "Имя" должно быть непустым');
        }

        if(!validate.email(emailField.val())) {
            emailField.css("border-color","red");
            errorPull.push('Поле "E-mail" имеет неверный формат');
        }

        if(!validate.blank(telefonField.val())) {
            telefonField.css("border-color","red");
            errorPull.push('Поле "Телефон" должно быть непустым');
        }

        if(errorPull.length==0) {
            $(this).parents('form').first().submit();
            return ;
        }
        $("#window-checkout .error-text").empty();
        $("#window-checkout .error-text").text('Некоторые поля заполнены с ошибками')
//        for(i in errorPull) {
//            $("#window-checkout .error-text").append(errorPull[i] + '<br>');
//        }
        errorPull = [];
    })

    $(".action-button").click(function(){
        var href = $(this).attr("href");
        $("#window-checkout form").attr("action", href);
        $.colorbox({
            href: "#window-checkout",
            inline: true
        });
    })
})

