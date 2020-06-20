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
        return $this->isSuccessful() ? (string)$this->data->AuthCode : (string)$this->data->Result;
    }

    public function getMessage(): string
    {
        if ($this->getCode() == '19' && $this->data->Message == 'Orig Tx not found.') {
            return (string)$this->data->RespMSG;
        }
        return trim(preg_replace('/\d+:/', '', $this->data->Message));
    }

    public function isSuccessful(): bool
    {
        return ((string)$this->data->RespMSG) === 'Approved' ? true : false;
    }

    public function getTransactionReference(): string
    {
        return (string)$this->data->PNRef;
    }
}
