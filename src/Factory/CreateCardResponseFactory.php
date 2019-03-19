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
        $data = $this->extractDataFromResponse($response);

        return new CreateCardResponse($request, $data);
    }

    private function extractDataFromResponse($response): array
    {
        $xml = new SimpleXMLElement($response);
        $cardReference = (string) $xml->PNRef;
        $isSuccessful = (string)$xml->RespMSG === 'Approved' ? true : false;
        $message = (string) $xml->Message;

        return [
            'cardReference' => $cardReference,
            'message' => $message,
            'success' => $isSuccessful,
        ];
    }
}
