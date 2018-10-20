<?php

namespace Omnipay\SmartPayments;

use Omnipay\Common\AbstractGateway;

/**
 * SmartPayments Gateway
 * @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface capture(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface refund(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface void(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = [])
 * @method \Omnipay\Common\Message\RequestInterface authorize(array $options = [])
 */
class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'SmartPayments';
    }

    public function getDefaultParameters()
    {
        return [
            'password' => '',
            'username' => '',
        ];
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    /**
     * @return Message\PurchaseRequest
     */
    public function createCard(array $options = [])
    {
        return $this->createRequest('\Omnipay\SmartPayments\Message\CreateCardRequest', $options);
    }

    /**
     * @return Message\PurchaseRequest
     */
    public function purchase(array $options = [])
    {
        return $this->createRequest('\Omnipay\SmartPayments\Message\PurchaseRequest', $options);
    }

    public function __call(
        $name,
        $arguments
    ) {
        // TODO: Implement @method \Omnipay\Common\Message\NotificationInterface acceptNotification(array $options = [])
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completeAuthorize(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface capture(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface purchase(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface completePurchase(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface refund(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface fetchTransaction(array $options = [])
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface void(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
        // TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
    }
}
