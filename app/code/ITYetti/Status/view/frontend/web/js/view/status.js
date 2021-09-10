define([
    'uiComponent',
    'jquery',
    'ITYetti_Status/js/service/status',
    'Magento_Customer/js/customer-data'
], function (Component, $, statusService, customerData) {
    'use strict';

    return Component.extend({
        defaults: {
            newStatusLabel: '',
        },

        initialize: function () {
            this._super();
            this.updateStatusOnFront();
        },

        initObservable: function () {
            this._super().observe(['newStatusLabel']);

            return this;
        },

        updateStatusOnFront: function() {
            customerData.reload(['customer'], false);
            var customer = customerData.get('customer');
            this.changeStatus = customer().changeStatus;
        },

        addStatus: function () {
            var status = this.newStatusLabel()
            statusService.update(status);
            setTimeout(this.updateStatusOnFront, 1000);
            this.newStatusLabel('');
        }
    });
});
