<?php

namespace Omnipay\SmartPayments\Message;

use Omnipay\SmartPayments\Factory\CreateCardResponseFactory;

/**
 * Authorize Request
 *
 * @method Response send()
 */
class CreateCardRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('card');
        $card = $this->getCard();
        $card->validate();
        $data = array_merge(
            $this->getBaseData(),
            [
                'TransType'  => 'Auth',
                'Amount'     => 0,
                'Street'     => $card->getBillingAddress1(),
                'CardNum'    => $card->getNumber(),
                'ExpDate'    => $card->getExpiryDate('my'),
                'NameOnCard' => $card->getName(),
                'CVNum'      => $card->getCvv(),
                'Zip'        => $card->getBillingPostcode(),
            ]
        );

        return $data;
    }

    protected function getResponseFactory()
    {
        return CreateCardResponseFactory::class;
    }
}
