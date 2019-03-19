<?php
namespace Omnipay\SmartPayments\Message;
use Omnipay\SmartPayments\Factory\PurchaseResponseFactory;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        $data = array_merge(
            $this->getBaseData(),
            [
                'TransType'  => 'RepeatSale',
                'PNRef' => $this->getCardReference(),
                'Amount' => $this->getAmount(),
            ]
        );

        return $data;
    }


    protected function getResponseFactory()
    {
        return PurchaseResponseFactory::class;
    }
}
