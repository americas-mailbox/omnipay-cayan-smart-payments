<?php

namespace Omnipay\SmartPayments\Message;

class CreateCardResponse extends Response
{
    public function getCardReference()
    {
        return (string) $this->data->PNRef;
    }
}
