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
        $data = $this->extractDataFromResponse($response);

        return new PurchaseResponse($request, $data);
    }

    private function extractDataFromResponse($response): array
    {
        $xml = new SimpleXMLElement($response);
        $authorizationCode = (string) $xml->AuthCode;
        $isSuccessful = (string)$xml->RespMSG === 'Approved' ? true : false;

        return [
            'authorizationCode' => $authorizationCode,
            'success' => $isSuccessful,
        ];
    }
}
