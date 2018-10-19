<?php
namespace Omnipay\SmartPayments\Message;
/**
 * Authorize Request
 *
 * @method Response send()
 */
class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        if ($this->getCardReference()) {
            return $this->getRepeatSaleData();
        }

    }

    private function getRepeatSaleData()
    {

    }
}
