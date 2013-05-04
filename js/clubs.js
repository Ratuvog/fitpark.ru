/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    // Create slider
    $(".slider").each(function(){
        var self = $(this);
        self.next(".slider-input").find('[name="rangeF"]').val(parseInt(self.attr("from")));
        self.next(".slider-input").find('[name="rangeT"]').val(parseInt(self.attr("to")));
        $( this ).slider({
            range: true,
            min: parseInt(self.attr("from")),
            max: parseInt(self.attr("to")),
            values: [ parseInt(self.attr("from")), parseInt(self.attr("to")) ],
            slide: function( event, ui ) {
                self.next(".slider-input").find('[name="rangeF"]').val(ui.values[ 0 ]);
                self.next(".slider-input").find('[name="rangeT"]').val(ui.values[1]);
            }
        });
    })

    // Схлопывание пунктов меня в фильтре
    $(".name-option").click(function(){
        var self = $(this);
        if(self.data("state")==="collapse") {
            self.find('.state-option').removeClass("right-arrow").addClass("arrow");
            self.next().fadeIn();
            self.data("state","expand");
        } else {
            self.find('.state-option').removeClass("arrow").addClass("right-arrow");
            self.data("state","collapse");
            self.next().fadeOut();
        }
    })

    // Сортировка

    function parseGetParams() {
        var $_GET = {};
        var __GET = window.location.search.substring(1).split("&");
        for (var i = 0; i < __GET.length; i++) {
            var getVar = __GET[i].split("=");
            $_GET[getVar[0]] = typeof(getVar[1]) == "undefined" ? "" : getVar[1];
        }
        return $_GET;
    }

    function implodeGet(currentObj){
        var returnString = "?";
        for(i in currentObj) {
            if(i && currentObj[i]) {
                returnString+=i+"="+currentObj[i]+"&";
            }
        }
        return returnString.substr(0,returnString.length-1);
    }

    $(".type-sort").delegate("a", 'click', function(){
        var currentGet = parseGetParams();
        currentGet['order'] = $(this).attr("href");
        var url      = location.href;
        var indexGet = url.indexOf("?");
        if(indexGet!=-1) {
            url = url.substr(0,indexGet);
        }
        location.href = url+implodeGet(currentGet);
        return false;
    })

    $(".sorter").click(function(){
        $("#filter").attr('action',$(this).attr('href'));
        $("#filter").submit();
    })

    // ПРименение натроек фильтра
    $("#submit-filter").click(function(){
        $("#filter").submit();
    })
})
