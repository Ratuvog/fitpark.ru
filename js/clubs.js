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


    $(".sorter").click(function(){
        $("#filter").attr('action',$(this).attr('href'));
        $("#filter").submit();
    })


})
