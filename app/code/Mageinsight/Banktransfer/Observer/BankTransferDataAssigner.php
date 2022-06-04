<?php

namespace Mageinsight\Banktransfer\Observer;

use Magento\Framework\Event\Observer;
use Magento\Payment\Observer\AbstractDataAssignObserver;
use Magento\Quote\Api\Data\PaymentInterface;

class BankTransferDataAssigner extends AbstractDataAssignObserver
{
    const ACCOUNT_HOLDER = 'account_holder';
    const IBAN_NUMBER = 'iban_number';
    const BIC = 'bic';

    /**
     * @var array
     */
    protected $additionalInformationList = [
        self::ACCOUNT_HOLDER,
        self::IBAN_NUMBER,
        self::BIC
    ];

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $data = $this->readDataArgument($observer);

        $additionalData = $data->getData(PaymentInterface::KEY_ADDITIONAL_DATA);
        if (!is_array($additionalData)) {
            return;
        }

        $paymentInfo = $this->readPaymentModelArgument($observer);

        foreach ($this->additionalInformationList as $additionalInformationKey) {
            if (isset($additionalData[$additionalInformationKey])) {
                $paymentInfo->setAdditionalInformation(
                    $additionalInformationKey,
                    $additionalData[$additionalInformationKey]
                );
            }
        }
    }
}