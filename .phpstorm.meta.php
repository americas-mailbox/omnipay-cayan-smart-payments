<?php

namespace PHPSTORM_META {

    /** @noinspection PhpIllegalArrayKeyTypeInspection */
    /** @noinspection PhpUnusedLocalVariableInspection */
    $STATIC_METHOD_TYPES = [
      \Omnipay\Omnipay::create('') => [
          'SmartPayments' instanceof \Omnipay\SmartPayments\Gateway,
      ],
      \Omnipay\Common\GatewayFactory::create('') => [
          'SmartPayments' instanceof \Omnipay\SmartPayments\Gateway,
      ],
    ];
}
