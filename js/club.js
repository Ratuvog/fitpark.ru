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
    
    $(".fit-rating").raty({      
        score: function() {
            return $(this).attr('data-score');
        }, 
        path : 'http://'+location.hostname+'/js/raty-2.5.2/img/',
        readOnly : function (){
            return ($(this).attr('ro') == 'true');
        },
        noRatedMsg: function() {
            return $(this).attr('title');
        },
        click: function(score, evt) {
              $.ajax({
                    url: 'http://'+location.hostname+'/club/vote/',
                    type: 'post',
                    data: {
                        'score' : score,
                        'vote-id' : $(this).attr('data-vote-id')
                    },
                    dataType: 'json',
                    success: function(data){
                        if(data.status == 'OK')
                        {
                            $('.rating-vote-answer').html(data.msg);
                            $(".rating,club-big").raty('readOnly', true);
                        }
                        else
                        {
                            $('.rating-vote-answer').html(data.msg);
                            $(".rating,club-big").raty('reload');
                        }
                        $('.rating-vote-answer').fadeOut(3000);
                    }
            });
        }
    });
    
    $(".rating").raty({      
        score: function() {
            return $(this).attr('data-score');
        }, 
        path : 'http://'+location.hostname+'/js/raty-2.5.2/img/',
        readOnly : true,
        noRatedMsg: function() {
            return $(this).attr('title');
        }
    });
    
    /*ymaps.ready(function () {
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
        map.controls.add('searchControl');
        if(isClub)
        {
            map.geoObjects.add(new ymaps.Placemark(coords,{
                balloonContent: $("#page-club-map").attr('balloon-title')
            }));
        }
        
    });*/
    
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
    });
    
    function switchPage(tab)
    {
        $("#page-side-menu-info").find(".page-side-menu-info").each(function(){
            $(this).hide();
        })
        var pointer = tab.attr("pointer");
        $("#slide-pointer").animate({ top: pointer }, 500);
        $("#"+tab.attr("for")).show();
    }
    
    function selectPageOnLoad()
    {
        var page = $("#page-club-side-menu").attr('active-page');
        if(page === 'comments')
            switchPage($("#page-side-menu-info-comment-tab"));
    }
    selectPageOnLoad();
    
    $(".page-side-menu-info-tab").click(function(){
        var self = $(this);
        switchPage(self);
    });
    
    $(".dialog-ajax-form").ajaxForm({
       dataType: 'json',
       success: function(data) {
           var type;
           if(data.status === 'OK')
           {
               type = 'success';
               $.colorbox.close();
               $(".dialog-ajax-form").clearForm();
           }
           else
               type = 'info';

           var n = noty({
               layout: 'topRight',
               timeout: 5000,
               text : data.msg,
               type : type
           });
       }
    });
});