<?php
declare(strict_types=1);

use League\SmartPayments\Test\Fixture\TestRequest;
use Omnipay\SmartPayments\Message\CreateCardResponse;
use Omnipay\Tests\TestCase;

class CreateCardResponseTest extends TestCase
{
    public function testGetCardReference()
    {
        $response = $this->generateResponse();
        $this->assertSame('1496856097', $response->getCardReference());
    }

    private function gatewayPurchaseResponse(): string
    {
        return <<<RESPONSE
<?xml version="1.0" encoding="utf-8"?>
<Response xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://TPISoft.com/SmartPayments/">
  <Result>0</Result>
  <RespMSG>Approved</RespMSG>
  <Message>85: Card OK on Verification Request</Message>
  <AuthCode>004841</AuthCode>
  <PNRef>1496856097</PNRef>
  <HostCode>907803400222</HostCode>
  <GetAVSResult>Y</GetAVSResult>
  <GetAVSResultTXT>Address Match + 5 Zip</GetAVSResultTXT>
  <GetStreetMatchTXT>Match</GetStreetMatchTXT>
  <GetZipMatchTXT>Match</GetZipMatchTXT>
  <GetCVResult>M</GetCVResult>
  <GetCVResultTXT>Match</GetCVResultTXT>
  <GetCommercialCard>False</GetCommercialCard>
  <ExtData>InvNum=WEB ,CardType=VISA&lt;ReceiptData&gt;&lt;Approved_Amt&gt;0.00&lt;/Approved_Amt&gt;&lt;/ReceiptData&gt;</ExtData>
</Response>
RESPONSE;
    }

    private function generateResponse(): CreateCardResponse
    {
        return new CreateCardResponse(new TestRequest(), new SimpleXMLElement($this->gatewayPurchaseResponse()));
    }
}
