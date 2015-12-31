var AEngine = AEngine || {};

(function (AEngine, Backbone, _, $) {
    'use strict';
    AEngine.View = {};
    AEngine.Model={};
    AEngine.Collection={};
    /**
     * Module define
     * @type {{}}
     */
    AEngine.Module = {};
    AEngine.View = {};
    AEngine.Collection = {};
    /**
     * Event define
     * @type Backbone.Events
     */
    AEngine.Event = {};
    _.extend(AEngine.Event, Backbone.Events);


    var EngineApplication = Backbone.Marionette.Application.extend({
        initialize: function(options) {
            console.log('App initialize', options);
        },
        onMapLoaded:function(){
            AEngine.Event.trigger('map:loaded');
        }
    });
    /**
     * Mail application
     */
    AEngine.App = new EngineApplication();
    AEngine.App.on("start", function(options){
        console.log('App Start', options);
        if (Backbone.history){
            Backbone.history.start();
            console.log('History Start', options);
        }
    });

    $( document ).ready(function() {
        AEngine.Event.trigger('document:ready');
    });
})(AEngine, Backbone, _, jQuery);