var AEngine = AEngine || {};

(function (AEngine, Backbone, $) {
    'use strict';
    AEngine.Module.Form.View = AEngine.Module.Form.View || {};
    AEngine.Module.Form.View.GalleryFieldView = Marionette.CollectionView.extend({
        initialize: function(options) {
            this.options = _.extend(this, options);
            try {
                this.options.args = JSON.parse(this.$el.$('.data-args').html());
                this.collection = JSON.parse(this.$el.$('.data-value').html());
            }catch (e){
                throw new Error(e.message);
            }
        },
    });

})(AEngine, Backbone, jQuery);