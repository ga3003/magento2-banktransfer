define(
    [
        'ko',
        'Magento_Checkout/js/view/payment/default',
        'jquery',
        'mage/validation'
    ],
    function (ko, Component,$) {
        'use strict';

        return Component.extend({
            defaults: {
                template: 'Mageinsight_Banktransfer/payment/banktransfer',
                account_holder: window.checkoutConfig.customerData.firstname + ' ' + window.checkoutConfig.customerData.lastname,
                iban_number: '',
                bic: ''
            },

            getData: function() {
                return {
                    'method': this.item.method,
                    'additional_data': {
                        'account_holder': $('input[name="payment[account_holder]"]').val(),
                        'iban_number': $('input[name="payment[iban_number]"]').val(),
                        'bic': $('input[name="payment[bic]"]').val(),
                    }
                };
            },

            /**
             * Get value of instruction field.
             * @returns {String}
             */
            getInstructions: function () {
                return window.checkoutConfig.payment.instructions[this.item.method];
            },
        });
    }
);