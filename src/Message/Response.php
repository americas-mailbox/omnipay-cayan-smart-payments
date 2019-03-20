<?php

namespace Omnipay\SmartPayments\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Response
 */
class Response extends AbstractResponse
{
    /** @var SimpleXMLElement */
    protected $data;

    public function getCode()
    {
        return (string) $this->data->AuthCode;
    }

    public function getMessage()
    {
        return (string) $this->data->Message;
    }

    public function isSuccessful()
    {
        return ((string) $this->data->RespMSG) === 'Approved' ? true : false;
    }

    public function getTransactionReference()
    {
        return (string) $this->data->PNRef;
    }
}
