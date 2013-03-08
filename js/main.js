/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    function UserException(message) {
        this.message = message;
        this.name = "UserException";
    }
    var slider = {
        currentIndexImg : 0,
        prevIndex: 0,
        slider : $("#slider"),
        buttons : $(".main-control .non-active-point"),
        intervalID: 0,
        images : $("#slider").find("img"),
        init : function() {
            var self = this;
            this.images.each(function(){
                $(this).hide();
            })
            var index = 0;
            this.buttons.each(function(){
                $(this).attr("index",index++);
            })
            index = 0;
            this.images.each(function(){
                $(this).attr("index",index++);
            })
            this.buttons.click(function(){
                clearInterval(self.intervalID);
                var index = parseInt($(this).attr("index"));
//                self.currentIndexImg = index;
                self.show(index);
                self.run();
            })
            this.show(this.currentIndexImg);
            this.run();
        },
        run: function(){
            var self = this;
//            this.show(this.currentIndexImg);
            this.intervalID = setInterval(function(){
                self.show.call(self,self.currentIndexImg)
            }, 10000);
        },
        show: function(index) {
            if(index>=this.images.length)
                index = 0;
            var self = this;
            $(this.images[this.prevIndex]).fadeOut(1000,function(){
                $(self.images[index]).fadeIn(1000);
            })
//            $(this.images[this.currentIndexImg]).hide();
            this.activateButton(index);
            this.prevIndex = index;
            this.currentIndexImg = index+1;
//            this.run();
        },
        activateButton: function(index) {
            this.buttons.each(function(){
                $(this).removeClass("active-point").addClass("non-active-point");
            })
            $(this.buttons[index]).addClass("active-point");
        }
    }
    slider.init();
})

