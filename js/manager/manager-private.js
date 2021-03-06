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
                url: 'http://'+location.hostname+'/manager/districts/',
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
    $( "#toggle" ).click(function() {
        $( "#city-combobox" ).toggle();
    });
  }
   
  createDistrictCombobox = function() {
    $( "#district-combobox" ).combobox({
        title: 'Показать все районы',
        noMatch: 'Такого района нет в базе'
    });
    $( "#toggle" ).click(function() {
      $( "#district-combobox" ).toggle();
    });
  };
  
$(function() {
               
    createCityCombobox();
    createDistrictCombobox();

    FormSaver.storeFormState();

    $("#common-save").click(function (){
        FormSaver.saveClicked($(this), 'manager/saveCommon');
    });
        
    $("#prices-save").click(function (){
        FormSaver.saveClicked($(this), 'manager/savePrices');
    }); 
    
    $("#descript-save").click(function (){
        FormSaver.saveClicked($(this), 'manager/saveDescription');
    });
    
    $("#service-save").click(function (){
        FormSaver.saveClicked($(this), 'manager/saveServices');
    });
     
    updateLastTimeUpdate = function () {
        $.ajax({
            url: 'http://'+location.hostname+'/manager/lastTimeUpdate',
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
    };

    CKEDITOR.on('instanceCreated', function (e) {
        e.editor.on('change', function (ev) {
            $('textarea[name="descript"]').val(ev.editor.getData());
        });
    });
    CKEDITOR.replace("descript", { customConfig : './mini-desc-ta.config.js'});

    var uploadButton = $('<button/>')
            .addClass('btn')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $("#logo-save").click(function(){
        var status = {
            text: "Изменений нет",
            type: "information"
        }
        FormSaver.showResultMessage(status);
    })
    $('#fileupload').fileupload({
        url: 'http://'+location.hostname+'/manager/logoUpload/',
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 1000000, // 100kb
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator && navigator.userAgent),
        previewMaxWidth: 160,
        previewMaxHeight: 160,
        previewCrop: true,
        imageMaxWidth: 800,
        imageMaxHeight: 600
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            data.context = $("div.img-placeholder")
            $("#logo-save")
                .data(data)
                .off("click")
                .on("click", function(){
                    var $this = $(this),
                        currentData  = $this.data();
                    currentData.formData = {clubId: $this.attr("clubId")};
                    $this.off("click").on("click", function(){
                        var status = {
                            text: "Изменений нет",
                            type: "information"
                        }
                        FormSaver.showResultMessage(status);
                    })
                    currentData.submit().always(function () {
                        $this.prop("disable", true);
                    });
                })

            $("div.img-placeholder").empty().appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context);
        if (file.preview) {
            node
                .html(file.preview);
        }
    }).on('fileuploaddone', function (e, data) {
        var status = {
            text: "Обновление логотипа прошло успешно",
            type: "success"
        }
        FormSaver.showResultMessage(status);
    }).on('fileuploadfail', function (e, data) {
        var status = {
            text: "Обновление логотипа завершилось с ошибкой",
            type: "error"
        }
        FormSaver.showResultMessage(status);
    });

    $("#auth-button").click(function(){
        $(this).parent('form').submit();
    });


});
     
