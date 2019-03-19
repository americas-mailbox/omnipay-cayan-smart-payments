<?php
declare(strict_types=1);

namespace Omnipay\SmartPayments\Message;

final class PurchaseResponse extends Response
{
    public function getAuthorizationCode()
    {
        return $this->data['authorizationCode'];
    }
}
