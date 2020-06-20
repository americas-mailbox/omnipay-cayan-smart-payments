<?php

namespace Omnipay\SmartPayments\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Response
 */
class Response extends AbstractResponse
{
    /** @var \SimpleXMLElement */
    protected $data;

    public function getCode(): string
    {
        return (string) $this->data->AuthCode;
    }

    public function getMessage(): string
    {
        return (string) $this->data->Message;
    }

    public function isSuccessful(): bool
    {
        return ((string) $this->data->RespMSG) === 'Approved' ? true : false;
    }

    public function getTransactionReference(): string
    {
        return (string) $this->data->PNRef;
    }

    public function getResponseActionCode(): string
    {
        return (string) $this->data->Result;
    }

    public function getResponseActionMessage(): string
    {
        return (string) $this->data->RespMSG;
    }
}
