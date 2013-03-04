/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    // Create slider
    $(".slider").each(function(){
        var self = $(this);
        $( this ).slider({
            range: true,
            min: parseInt(self.attr("from")),
            max: parseInt(self.attr("to")),
            values: [ parseInt(self.attr("from")), parseInt(self.attr("to")) ],
            slide: function( event, ui ) {
                self.prev().text("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
                self.next('[name="from"]').val(ui.values[ 0 ]);
                self.next('[name="to"]').val(ui.values[1]);
            }
        });
    })

})
