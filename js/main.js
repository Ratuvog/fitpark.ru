/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    var slider = $('.bxslider').bxSlider({
        mode: 'horizontal',
        auto: true,
        speed: 1000,
        pause: 10000,
        tickerHover: false,
        pager: false,
        controls: false,
        onSlideBefore: function($slideElement, oldIndex, newIndex){
            if(oldIndex>=0 && oldIndex<=2)
                $(".control-slide div:eq("+oldIndex+")").removeClass('active-point').addClass('non-active-point');
            $(".control-slide div:eq("+newIndex+")").addClass('active-point');
        }
    });
    $(".control-slide").delegate('div', 'click', function() {
        var indexPage = parseInt($(this).attr("index"));
        slider.stopAuto();
        slider.goToSlide(indexPage);
        slider.startAuto();
        return false;
    })
})

