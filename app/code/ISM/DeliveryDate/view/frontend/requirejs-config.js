var config = {
    "map": {
        "*": {
            'Magento_Checkout/js/model/shipping-save-processor/default': 'ISM_DeliveryDate/js/model/shipping-save-processor/default'
        }
    },
    config: {
        mixins: {
            'Magento_Checkout/js/view/shipping': {
                'ISM_DeliveryDate/js/mixin/shipping-mixin': true
            },
            'Amazon_Payment/js/view/shipping': {
                'ISM_DeliveryDate/js/mixin/shipping-mixin': true
            }
        }
    }
};
