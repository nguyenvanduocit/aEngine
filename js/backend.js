var AEngine = AEngine || {};

(function (AEngine, Backbone, $) {
    'use strict';
    AEngine.Module.Backend = Marionette.Module.extend({
        initialize: function(moduleName, app, options) {
            console.log(moduleName + ' initialize');
        },
        onStart: function(options) {
            console.log(this.moduleName + ' start');
        },
    });
    AEngine.App.module("Backend", {
        moduleClass: AEngine.Module.Backend
    });
})(AEngine, Backbone, jQuery);