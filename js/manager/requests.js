/**
 * Created by dmitry on 12/25/13.
 */
$(function(){
    var ACTIVE_STATE = 1;
    var ACCEPT_STATE = 2;
    var REJECT_STATE = 3;
    var Request = Backbone.Model.extend({
        default: function(){
            return {
                'id': '',
                'date': '',
                'name': '',
                'surname': '',
                'e-mail': '',
                'duration': '',
                'tel': '',
                'state': 1
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

    var requestList = new RequestsList;

    var RequestView = Backbone.View.extend({
        tagName: 'tr',
        template: _.template($("#requestView").html()),
        events:{
            "click .accept-request": "accept",
            "click .reject-request": "reject"
        },
        initialize: function(){
            this.model.bind('change', this.render, this);
            this.model.bind('remove', this.remove, this);
        },
        render: function(){
            this.$el.html(this.template(this.model.toJSON()));
            return this;
        },
        __updateState: function(msg, state){
            if(confirm(msg))
            {
                var self = this;
                this.model.save(
                    {'state': state},
                    {
                        'success':function(){
                            requestList.remove(self.model);
                            noty({
                                layout: 'topRight',
                                timeout: 3000,
                                text : "Данные успешно обновлены",
                                type : "success"
                            })
                        },
                        'error': function(){
                            noty({
                                layout: 'topRight',
                                timeout: 3000,
                                text : "Во время обновления данных произошли ошибки",
                                type : "error"
                            })
                        }
                    }
                );
            }
        },
        accept: function(){
            this.__updateState("Вы действительно хотите отметить данную заявку на абонемент как принятую?", ACCEPT_STATE)
        },
        reject: function(){
            this.__updateState("Вы действительно хотите отметить данную заявку на абонемент как отмененную?", REJECT_STATE)
        }
    })

    var AppView = Backbone.View.extend({
        el: $(".save-form"),
        initialize: function(){
            this.requestList = this.$("#requestList");
            this.emptyRequestListMessage = this.$("#emptyRequestList");
            requestList.bind('all', this.render, this);
            requestList.bind('sync', this.addAll, this);
            requestList.fetch();
        },

        addOne: function(request){
            var view = new RequestView({model: request});
            this.$("table tbody").append(view.render().el);
        },

        addAll: function(){
            requestList.each(this.addOne);
        },

        render: function(){
            if (requestList.length) {
                this.requestList.show();
                this.emptyRequestListMessage.hide();
            } else {
                this.requestList.hide();
                this.emptyRequestListMessage.show();
            }
        }
    })

    Backbone.history.start();
    var app = new AppView;
})