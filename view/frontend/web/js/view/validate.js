define([
    'Magento_Customer/js/customer-data',
    'jquery'
], function (customerData, $) {
    'use strict';

    $("#submit").click(function () {
        var formData = {
            status: $("#status").val(),
        };
        $.ajax({
            type: "POST",
            url: "/smart_customer/status/save",
            data: formData,
            dataType: "json",
            encode: true,
            success: function (data) {
                if (data.status) {
                    var sections = ['customer-status'];
                    customerData.invalidate(sections);
                    customerData.reload(sections, true);
                }
            },
        });
    });

    return function () {
    };
});

