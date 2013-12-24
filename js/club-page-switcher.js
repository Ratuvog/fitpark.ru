/**
 * Created by dmitry on 12/24/13.
 */

$(function(){
    var pages = $("#page-side-menu-info").find(".page-side-menu-info");
    var descriptionPage = $("#page-side-menu-info-tz");
    var photoPage = $("#page-side-menu-info-photo");
    var reviewPage = $("#page-side-menu-info-comments");
    var pointerDesc = 35;
    var pointerPhoto = 105;
    var pointerReview = 165;
    var sliderPointer = $("#slide-pointer");
    var Controller = Backbone.Router.extend({
        routes: {
            ""          : "description",
            "!/"        : "description",
            "!/photo"   : "photo",
            "!/review"  : "review"
        },
        _hideAll: function(){
            pages.each(function(){
                $(this).hide();
            });
        },
        _showPage: function(page, pointer){
            this._hideAll();
            sliderPointer.animate({ top: pointer }, 500);
            page.show();
        },
        description: function(){
            this._showPage(descriptionPage,pointerDesc);
        },

        photo: function(){
            this._showPage(photoPage, pointerPhoto)
        },

        review: function(){
            this._showPage(reviewPage, pointerReview);
        }
    })

    var controller = new Controller;
    Backbone.history.start();
});