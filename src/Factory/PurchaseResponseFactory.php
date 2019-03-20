<?php
declare(strict_types=1);

namespace Omnipay\SmartPayments\Factory;

use Omnipay\SmartPayments\Message\PurchaseRequest;
use Omnipay\SmartPayments\Message\PurchaseResponse;
use SimpleXMLElement;

final class PurchaseResponseFactory
{
    public function handle(PurchaseRequest $request, $response): PurchaseResponse
    {
        return new PurchaseResponse($request, new SimpleXMLElement($response));
    }
}
