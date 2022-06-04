<?php

namespace Mageinsight\Banktransfer\Model;

class Banktransfer extends \Magento\OfflinePayments\Model\Banktransfer
{
    /**
     * @var string
     */
    protected $_infoBlockType = \Mageinsight\Banktransfer\Block\Info\BankTransfer::class;
}