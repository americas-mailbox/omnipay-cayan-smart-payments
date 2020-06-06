<?php

namespace Omnipay\SmartPayments\Message;

use Omnipay\SmartPayments\Factory\CreateCardResponseFactory;
use Omnipay\Common\Exception\InvalidCreditCardException;

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
        $this->customCardValidate();
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

    private function customCardValidate()
    {
        $requiredParameters = array(
          'number' => 'credit card number',
          'expiryMonth' => 'expiration month',
          'expiryYear' => 'expiration year'
        );

        foreach ($requiredParameters as $key => $val) {
            if (!$this->getCard()->getParameter($key)) {
                throw new InvalidCreditCardException("The $val is required");
            }
        }

        if ($this->getCard()->getExpiryDate('Ym') < gmdate('Ym')) {
            throw new InvalidCreditCardException('Card has expired');
        }
        // skip the luhn algorithm for card validation
        if (false && !Helper::validateLuhn($this->getCard()->getNumber())) {
            throw new InvalidCreditCardException('Card number is invalid');
        }

        if (!is_null($this->getCard()->getNumber()) && !preg_match('/^\d{12,19}$/i', $this->getNumber())) {
            throw new InvalidCreditCardException('Card number should have 12 to 19 digits');
        }
    }
}
