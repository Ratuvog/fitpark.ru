/**
 * Created by dmitry on 12/25/13.
 */
$(function(){
    var Request = Backbone.Model.extend({
        default: function(){
            return {
                'id': '',
                'type': '',
                'name': '',
                'tel': '',
                'e-mail': '',
                'clubid': ''
            }
        },

        initialize: function(){

        }
    })

    var RequestsList = Backbone.Collection.extend({
        model: Request,
        url: function(){
            return 'http://'+location.hostname + '/Request/'+CURRENT_CLUB_ID
        }
    })

    var list = new RequestsList;

    var requests = new RequestsList;
    var RequestView = Backbone.View.extend({
        tagName: 'tr',
        template: _.template($("#requestView").html()),
        events:{
            "click .edit-request": "edit"
        },
        initialize: function(){
            this.model.bind('change', this.render, this);
            this.model.bind('destroy', this.remove, this);
        },
        render: function(){
            this.$el.html(this.template(this.model.toJSON()));
        },
        edit: function(){
            router.navigate("edit/"+this.model.get('id'));
        }
    })


    var Router = Backbone.Router.extend({
        routes: {
            "": "main",
            "edit/:requestid": "edit"
        },
        main: function(){
            $("#editRequest").hide();
            $("#requestList").show();
            alert(location.hostname)
        },
        edit: function(requestId) {
            $("#editRequest").show();
            $("#requestList").hide();
        }
    })

    var router = new Router;
    Backbone.history.start();
    list.fetch();
})