var AEngine = AEngine || {};

(function (AEngine, Backbone, $) {
    'use strict';
    AEngine.Module.Form = Marionette.Module.extend({
        initialize: function(moduleName, app, options) {
            console.log(moduleName + ' initialize');
        },
        onStart: function(options) {
            console.log(this.moduleName + ' start');
            this.listenTo(AEngine.Event, 'document:ready', this.onDocumentReady);
        },
        onDocumentReady:function(){
            var self  = {};
            var $galleryField = $('.ae_gallery_field');

            if($galleryField.length > 0){
                $galleryField.each(function(){
                    var $target = $(this);
                    var id = $target.attr('id');
                    self[id] = new  AEngine.Module.Form.View.GalleryFieldView({
                        el : $target
                    });
                });
            }
        }
    });
    AEngine.App.module("Form", {
        moduleClass: AEngine.Module.Form
    });
})(AEngine, Backbone, jQuery);