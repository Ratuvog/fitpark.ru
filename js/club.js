/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    // Tabs
    $("#image-club").hide();
//    $("#review-club").hide();
    $(".tab-set > table").delegate('a','click',function(){
        var parentCell = $(this).parents('td');
        if(!parentCell.first().hasClass('tab'))
            return false;
        var parentTable = $(this).parents('table');
        parentTable.find('td').each(function(){
            $(this).removeClass('active-tab');
            var selector = $(this).attr("selector");
            $(selector).hide();
        })
        parentCell.addClass('active-tab');
        var selector = parentCell.attr("selector");
        $(selector).show();
        return false;
    })

    $(".submit-review").click(checkForm);
    
    $(".club-big").raty({
        score: function() {
            return $(this).attr('data-score');
        }, 
        path : 'http://'+location.hostname+'/js/raty-2.5.2/img/',
        hints : ['', '', '', '', ''],
        starHalf : 'star-half-big.png',
        starOff  : 'star-off-big.png',
        starOn   : 'star-on-big.png',
        size: 24,
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
                    }
            });
        }
    });
    
    $(".club-mini").raty({      
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

