define([
    'jquery',
    'ko',
    'Magento_Ui/js/form/element/abstract'
], function ($, ko, Component) {
    'use strict';

    return Component.extend({
        initialize: function () {
            this._super();
            let disabled = window.checkoutConfig.shipping.delivery_date.disabled;
            let noday = window.checkoutConfig.shipping.delivery_date.noday;
            let hourMin = parseInt(window.checkoutConfig.shipping.delivery_date.hourMin);
            let hourMax = parseInt(window.checkoutConfig.shipping.delivery_date.hourMax);
            let format = window.checkoutConfig.shipping.delivery_date.format;
            if(!format) {
                format = 'yy-mm-dd';
            }
            let disabledDay = disabled.split(",").map(function(item) {
                return parseInt(item, 10);
            });

            ko.bindingHandlers.datetimepicker = {
                init: function (element, valueAccessor, allBindingsAccessor) {
                    let $el = $(element);
                    //initialize datetimepicker
                    if(noday) {
                        var options = {
                            minDate: 0,
                            dateFormat:format,
                            hourMin: hourMin,
                            hourMax: hourMax
                        };
                    } else {
                        var options = {
                            minDate: 0,
                            dateFormat:format,
                            hourMin: hourMin,
                            hourMax: hourMax,
                            beforeShowDay: function(date) {
                                var day = date.getDay();
                                if(disabledDay.indexOf(day) > -1) {
                                    return [false];
                                } else {
                                    return [true];
                                }
                            }
                        };
                    }

                    $el.datetimepicker(options);

                    let writable = valueAccessor();
                    if (!ko.isObservable(writable)) {
                        let propWriters = allBindingsAccessor()._ko_property_writers;
                        if (propWriters && propWriters.datetimepicker) {
                            writable = propWriters.datetimepicker;
                        } else {
                            return;
                        }
                    }
                    writable($(element).datetimepicker("getDate"));
                },
                update: function (element, valueAccessor) {
                    let widget = $(element).data("DateTimePicker");
                    if (widget) {
                        let date = ko.utils.unwrapObservable(valueAccessor());
                        widget.date(date);
                    }
                }
            };

            return this;
        }
    });
});
