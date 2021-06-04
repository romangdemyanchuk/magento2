let config = {
    config: {
        mixins: {
            'ISM_DeliveryAt/js/action/place-order': {
                'ISM_DeliveryAt/js/order/place-order-mixin': true
            },
            'Magento_Checkout/js/action/set-payment-information': {
                'ISM_DeliveryAt/js/order/set-payment-information-mixin': true
            },
            'Magento_Checkout/js/action/set-shipping-information': {
                'ISM_DeliveryAt/js/order/set-shipping-information-mixin': true
            }
        }
    }
}
