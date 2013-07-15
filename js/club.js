$(function(){
    
    $("#rating-club-big").raty({      
        score: function() {
            return $(this).attr('data-score');
        }, 
        path : 'http://'+location.hostname+'/js/raty-2.5.2/img/',
        readOnly : true,
        starHalf : 'star-half-big.png',
        starOff  : 'star-off-big.png',
        starOn   : 'star-on-big.png',
        size: 24,
        noRatedMsg: function() {
            return $(this).attr('title');
        }
    });
    
    ymaps.ready(function () {
        var isClub = true;
        var zoom = 15;
        var coords = $("#page-club-map").attr('geo').split(',');
        if(coords.length < 2)
        {
            coords = $("#page-club-map").attr('city-geo').split(',');
            zoom = 12;
            isClub = false;
        }
        var map = new ymaps.Map ("page-club-map", {
            center: coords,
            zoom: zoom,
        });
        map.controls.add(new ymaps.control.ZoomControl());
        map.controls.add('typeSelector');
        if(isClub)
        {
            map.geoObjects.add(new ymaps.Placemark(coords,{
                balloonContent: $("#page-club-map").attr('balloon-title')
            }));
        }
        
    });
    
    function createDialog(form, href)
    {
        form.find('.error-text').empty();
        form.attr("action", href);
        form.on("click", ".button-send", checkForm);
        $.colorbox({
            href: form,
            inline: true
        });
    }
    
    
    $(".action-button").click(function(){
        createDialog($("#"+$(this).attr("for")), $(this).attr("href"));
    })

});