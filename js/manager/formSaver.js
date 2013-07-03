Status = {
        saveSuccess : {
            text: "Изменения добавлены на обработку",
            type: "success"
        },
        saveError : {
            text: "При обновлении произошла ошибка",
            type: "error"
        },
        validateError : {
            text: "Некоторые поля заполнены с ошибками",
            type: "error"
        },
        hasNotChanges : {
            text: "Изменений нет",
            type: "information"
        }
};



FormSaver = {
    sendToSave : function(form, funcName){
        var self = this;
        var formData = {};
        $(form).find('input,select,textarea').each(function (){
           if($(this).attr('type') === 'button')
               return;
           else if($(this).attr('type') === 'checkbox')
               formData[$(this).attr('name')] = this.checked;
           else
               formData[$(this).attr('name')] = $(this).val();
        });
        formData['clubid'] = $('#clubid').val();
        $.ajax({
            url: 'http://'+location.hostname+'/'+funcName+'/',
            type: 'post',
            dataType: 'json',
            data: formData,
            success: function(data){
                    if(data.status === 'OK')
                        self.showResultMessage( Status.saveSuccess);
                    else
                        self.showResultMessage( Status.saveError);
                    self.storeFormState(form);
                    updateLastTimeUpdate();
            },
            beforeSend: function(){
                var loading = $("<div>").addClass('ajax-loader');
                form.append(loading);
            },
            complete: function() {
                form.find(".ajax-loader").remove();
            }
        });
    },
    validateInput : function (input) {
        var validator = input.attr("validator");
        var textField = input.attr("placeholder");

        if(input.attr("type") === "checkbox")
            return "OK";

        if(input.attr("isReq") === "false")
            return "OK";

        if (!validate[validator].func(input.val()) ) {
            input.css("border-color", "red");
            return validate[validator].errorPattern(textField);
        }
        input.css("border-color", "#aaa");
        return "OK";
    },
    showResultMessage : function(status) {
//        $.noty.defaults = {
//            layout: 'top',
//            theme: 'defaultTheme',
//            dismissQueue: true, // If you want to use queue feature set this true
//            template: '<div class="noty_message"><span class="noty_text"></span><div class="noty_close"></div></div>',
//            animation: {
//                open: {height: 'toggle'},
//                close: {height: 'toggle'},
//                easing: 'swing',
//                speed: 500 // opening & closing animation speed
//            },
//            timeout: false, // delay for closing event. Set false for sticky notifications
//            force: false, // adds notification to the beginning of queue when set to true
//            modal: false,
//            closeWith: ['click'], // ['click', 'button', 'hover']
//            callback: {
//                onShow: function() {},
//                afterShow: function() {},
//                onClose: function() {},
//                afterClose: function() {}
//            },
//            buttons: false // an array of buttons
//        };
        alertInfo(status.text);
//        var mes = noty({
//            type: status.type,
//            text: status.text,
//            layout: 'topRight',
//            timeout: 2500
//        });
    },
    formStorage : {},
    storeFormState : function () {
        var forms = $('.save-form');
        var inputStorage = {};
        $(forms).each(function(){
            $(this).find('input,select,textarea').each(function()
            {
                var type = $(this).attr("type");
                if(type === "hidden" && type === "button" && type === "submit")
                    return;

                if($(this).attr('name')) {
                    if(type === "checkbox")
                        inputStorage[$(this).attr('name')] = this.checked;
                    else
                        inputStorage[$(this).attr('name')] = $(this).val();
                }
            });
        });
        this.formStorage = inputStorage;
    },
    formHasChanges : function (form) {
        var inputStorage = this.formStorage;
        var hasChanges = false;
        $(form).find('input,select,textarea').each(function()
        {
            var type = $(this).attr("type");
            if(type === "hidden" && type === "button" && type === "submit")
                return;

            if($(this).attr('name')) {
                if(type === "checkbox")
                    hasChanges = hasChanges || (inputStorage[$(this).attr('name')] !== this.checked);
                else
                    hasChanges = hasChanges || (inputStorage[$(this).attr('name')] !== $(this).val());
            }
        });
        return hasChanges;
    },
    saveClicked : function(button, funcName) {
        var self = this;
        var form = button.parents(".save-form").first();
        if(!this.formHasChanges(form)) {
            this.showResultMessage(form, Status.hasNotChanges);
            return;
        }
        var errorPull = [];
        form.find('input,textarea').each(function()
        {
            var type = $(this).attr("type");
            if(type !== "hidden" && type !== "button" && type !== "submit")
            {
                var error = self.validateInput($(this));
                if(error !== "OK")
                    errorPull.push(error);
            }
        });

        if (errorPull.length === 0)
        {
            self.sendToSave(form, funcName);
            return;
        }

        self.showResultMessage(form, $('<label>').addClass('save-error').append(errorPull[0]));
        errorPull = [];
    }
};


