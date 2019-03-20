<?php
declare(strict_types=1);

namespace Omnipay\SmartPayments\Factory;

use Omnipay\SmartPayments\Message\CreateCardRequest;
use Omnipay\SmartPayments\Message\CreateCardResponse;
use SimpleXMLElement;

class CreateCardResponseFactory
{
    public function handle(CreateCardRequest $request, $response): CreateCardResponse
    {
        return new CreateCardResponse($request, new SimpleXMLElement($response));
    }
}
