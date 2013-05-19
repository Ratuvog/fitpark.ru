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
})
