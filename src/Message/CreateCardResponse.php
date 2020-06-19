<?php

namespace Omnipay\SmartPayments\Message;

class CreateCardResponse extends Response
{
    public function getCardReference(): string
    {
        return (string) $this->data->PNRef;
    }
}
