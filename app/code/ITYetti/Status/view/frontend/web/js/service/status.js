define(['mage/storage'], function (storage) {
    'use strict';

    return {
        update: async function (status) {
            return storage.post(
                'rest/V1/customer/status/update',
                JSON.stringify({
                    status: status
                })
            );
        },
    };
});
