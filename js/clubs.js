/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    // Create slider
    $(".slider").each(function(){
        var self = $(this);
        var left =  $(".slider-from"),
            right = $(".slider-to");
        var leftInput = left.attr("value");
        var rightInput = right.attr("value");
        left.val(leftInput);
        right.val(rightInput);
        $( this ).slider({
            range: true,
            min: parseInt(self.attr("from")),
            max: parseInt(self.attr("to")),
            values: [ parseInt(leftInput), parseInt(rightInput) ],
            slide: function( event, ui ) {
                left.val(ui.values[0] ? ui.values[0] : 0);
                right.val(ui.values[1]);
            }
        });
        var changeValues = function(){
            self.slider("option", "values", [left.val(),right.val()]);
        };
        left.on("change keyup", changeValues);
        right.on("change keyup", changeValues);
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
    
    $(".rating").raty({      
        score: function() {
            return $(this).attr('data-score');
        }, 
        path : 'http://'+location.hostname+'/js/raty-2.5.2/img/',
        readOnly : true,
        noRatedMsg: function() {
            return $(this).attr('title');
        },
        hints: ['', '', '', '', '']

    });
})
