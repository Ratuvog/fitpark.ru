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
        },
        hasNotActiveCheckBox : {
            text: "Хотя бы один пункт должен быть активен",
            type: "error"
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
                        self.showResultMessage(Status.saveSuccess);
                    else
                        self.showResultMessage(Status.saveError);
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
        var n = noty({
            layout: 'topRight',
            timeout: 3000,
            text : status.text,
            type : status.type
        });
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
    hasActiveCheckBox: function (form) {
        var count = 0;
        var hasCB = false;
        $(form).find('input').each(function()
        {
            var type = $(this).attr("type");
            if(type === "checkbox") {
                hasCB = true;
                if(this.checked === true)
                    count++;
            }
                   
        });
        if(hasCB)
            return count;
        return true;
    },
    saveClicked : function(button, funcName) {
        var self = this;
        var form = button.parents(".save-form").first();
        if(!this.formHasChanges(form)) {
            this.showResultMessage(Status.hasNotChanges);
            return;
        }
        if(!this.hasActiveCheckBox(form)) {
            this.showResultMessage(Status.hasNotActiveCheckBox);
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
        
        self.showResultMessage({text:errorPull[0], type: "error"});
        errorPull = [];
    }
};


