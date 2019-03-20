<?php
declare(strict_types=1);

namespace League\SmartPayments\Test\Fixture;

use Omnipay\Common\Message\RequestInterface;

final class TestRequest implements RequestInterface
{
    protected function getResponseFactory()
    {
        // TODO: Implement getResponseFactory() method.
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        // TODO: Implement getData() method.
    }

    /**
     * Initialize request with parameters
     *
     * @param array $parameters The parameters to send
     */
    public function initialize(array $parameters = [])
    {
        // TODO: Implement initialize() method.
    }

    /**
     * Get all request parameters
     *
     * @return array
     */
    public function getParameters()
    {
        // TODO: Implement getParameters() method.
    }

    /**
     * Get the response to this request (if the request has been sent)
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function getResponse()
    {
        // TODO: Implement getResponse() method.
    }

    /**
     * Send the request
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function send()
    {
        // TODO: Implement send() method.
    }

    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return \Omnipay\Common\Message\ResponseInterface
     */
    public function sendData($data)
    {
        // TODO: Implement sendData() method.
    }
}

