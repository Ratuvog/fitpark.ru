 (function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
         
        this.options = $.extend({
          title: '',
          noMatch:'',
          afterSelect: function(){}
        }, this.options);
          
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .attr('validator', "empty")
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
            this.options.afterSelect();
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", this.options.title )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          this.options.afterSelect();
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", this.options.noMatch )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.data( "ui-autocomplete" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
})( jQuery );
 
  createCityCombobox = function() {
    $( "#city-combobox" ).combobox({
        title: 'Показать все города',
        noMatch: 'Такого города нет в базе',
        afterSelect: function () {

            var distrBox = $('#district-combobox');
            var cityBox = $('#city-combobox');

            distrBox.find('option').each(function(){
                this.remove();
            });
            distrBox.parent().find('input').val('');

            var city = cityBox.find('option:selected').val();
            $.ajax({
                url: 'http://'+location.hostname+'/ManagerPrivate/districts/',
                type: 'post',
                dataType: 'json',
                data: { 
                    'cityId' : city
                },
                success: function(data){
                    if(data.status === 'OK')
                    {
                        var options = data.msg;
                        for (var i = 0; i < options.length; i++)
                        {
                            var opt = '<option value="'+options[i].id+'">'+options[i].name+'</option>';
                            distrBox.append(opt);
                        }
                    }  
                }
            });


        }
    });
  }
   
  createDistrictCombobox = function() {
    $( "#district-combobox" ).combobox({
        title: 'Показать все районы',
        noMatch: 'Такого района нет в базе',
  });
  }
  
  $(function() {
    $("#common-save").click(function() {

        var form = $(this).parents(".save-form").first();
        
        if(!formHasChanges(form)) {
            var info = $('<label>').addClass("font-error").empty();
            info.append("Изменений нет");
            showResultMessage(form, info);
            return;
        }
        
        var errorPull = [];
        form.find('input,textarea').each(function()
        {
            var type = $(this).attr("type");
            if(type !== "hidden" && type != "button" && type != "submit")
            {
                var error = validateInput($(this));
                if(error !== "OK")
                    errorPull.push(error);
            }
        });
        
        if (errorPull.length === 0)
        {
            sendToSave(form);
            return;
        }
        
        var error = $('<label>').addClass("font-error").empty();
        error.append("Некоторые поля заполнены с ошибками");
        showResultMessage(form, error);
        errorPull = [];
     });
     
     sendToSave = function(form){
            var formData = {};
            $(form).find('input,select').each(function (){
               if($(this).attr('type') != 'button')
                   formData[$(this).attr('name')] = $(this).val();
            });
            formData['clubid'] = $('#clubid').val();
            $.ajax({
                url: 'http://'+location.hostname+'/ManagerPrivate/saveCommon/',
                type: 'post',
                dataType: 'json',
                data: formData,
                success: function(data){           
                        var mes = $('<label>');
                        if(data.status === 'OK')
                            mes.addClass('font-succes').append("Изменения добавлены на обработку");
                        else
                            mes.addClass('font-error').append("При обновлении произошла ошибка");
                        showResultMessage(form, mes);
                        storeFormState(form);
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
     }
     
    validateInput = function (input) {
        var validator = input.attr("validator");
        var textField = input.attr("placeholder");

        if(input.attr("isReq") === "false")
            return "OK";

        if (!validate[validator].func(input.val()) ) {
            input.css("border-color", "red");
            return validate[validator].errorPattern(textField);
        }
        input.css("border-color", "#aaa");
        return "OK";
    }
     
    showResultMessage = function(form, result) {
            $(form).find('.font-error').remove();
            $(form).find('.font-succes').remove();
            var save = $(form).find('.save');
            save.parent().append(result);
    } 
    
    var formStorage = {};
    
    storeFormState = function (form) {
        var inputStorage = {}
        $(form).find('input,select').each(function()
        {
            var type = $(this).attr("type");
            if(type !== "hidden" && type != "button" && type != "submit")
            {
                if($(this).attr('name'))
                    inputStorage[$(this).attr('name')] = $(this).val();
            }
        });
        formStorage[form] = inputStorage;
    }
    
    formHasChanges = function (form) {
        var inputStorage = formStorage[form];
        var hasChanges = false;
        $(form).find('input,select').each(function()
        {
            var type = $(this).attr("type");
            if(type !== "hidden" && type != "button" && type != "submit")
            {
                if($(this).attr('name') && inputStorage[$(this).attr('name')] != $(this).val())
                    hasChanges = true;
            }
        });
        return hasChanges;
    }
   
    updateLastTimeUpdate = function () {
        $.ajax({
            url: 'http://'+location.hostname+'/ManagerPrivate/lastTimeUpdate',
            type: 'post',
            dataType: 'json',
            data: { clubid: $('#clubid').val() },
            success: function(data){           
                if(data.status === 'OK'){
                    $('#last-update').empty();
                    $('#last-update').append(data.msg);
                }
            }
        });     
    }
   
    createCityCombobox();
    $( "#toggle" ).click(function() {
        $( "#city-combobox" ).toggle();
    });

    createDistrictCombobox();
    $( "#toggle" ).click(function() {
      $( "#district-combobox" ).toggle();
    });

    storeFormState($('#common-save').parents(".save-form").first());


    CKEDITOR.replace( 'textarea_id', {
    uiColor: '#14B8C4'
    });
        
});
     
