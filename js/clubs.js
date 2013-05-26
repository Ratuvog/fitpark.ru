/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    // Create slider
    $(".slider").each(function(){
        var self = $(this);
        var leftInput = $(".slider-from").attr("value");
        var rightInput = $(".slider-to").attr("value");
        self.next(".slider-input").find('[name="rangeF"]').val(leftInput);
        self.next(".slider-input").find('[name="rangeT"]').val(rightInput);
        $( this ).slider({
            range: true,
            min: parseInt(self.attr("from")),
            max: parseInt(self.attr("to")),
            values: [ parseInt(leftInput), parseInt(rightInput) ],
            slide: function( event, ui ) {
                self.next(".slider-input").find('[name="rangeF"]').val(ui.values[0]);
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
    
    $(".rating").rating({
        fx:     'full',
        image:  location.origin+'/js/jquery.rating/images/stars.png',
        loader: location.origin+'/js/jquery.rating/images/ajax-loader.gif',
        readOnly: true
    });
})
