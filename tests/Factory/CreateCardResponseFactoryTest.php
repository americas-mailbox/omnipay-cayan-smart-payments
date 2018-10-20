<?php
declare(strict_types=1);

namespace Factory;

use Mockery;
use Omnipay\SmartPayments\Factory\CreateCardResponseFactory;
use Omnipay\SmartPayments\Message\CreateCardRequest;
use Omnipay\Tests\TestCase;

final class CreateCardResponseFactoryTest extends TestCase
{
    /** @var CreateCardRequest */
    private $request;

    public function setUp()
    {
        $this->request = Mockery::mock(CreateCardRequest::class)->makePartial();
        $this->request->initialize();
    }

    public function testInvoke()
    {
        $response = (new CreateCardResponseFactory)->handle($this->request, $this->gatewayReponse());

        $this->assertTrue($response->isSuccessful());
        $this->assertSame('1295276898', $response->getCardReference());
    }

    private function gatewayReponse() {
        return <<<RESPONSE
<?xml version="1.0" encoding="utf-8"?>
<Response xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://TPISoft.com/SmartPayments/">
  <Result>0</Result>
  <RespMSG>Approved</RespMSG>
  <Message>00: Approved and completed</Message>
  <AuthCode>001160</AuthCode>
  <PNRef>1295276898</PNRef>
  <HostCode>829015003494</HostCode>
  <GetAVSResult>Y</GetAVSResult>
  <GetAVSResultTXT>Address Match + 5 Zip</GetAVSResultTXT>
  <GetStreetMatchTXT>Match</GetStreetMatchTXT>
  <GetZipMatchTXT>Match</GetZipMatchTXT>
  <GetCVResult>M</GetCVResult>
  <GetCVResultTXT>Match</GetCVResultTXT>
  <GetCommercialCard>False</GetCommercialCard>
  <ExtData>InvNum=WEB Postage,CardType=VISA&lt;ReceiptData&gt;&lt;Approved_Amt&gt;1.36&lt;/Approved_Amt&gt;&lt;/ReceiptData&gt;</ExtData>
</Response>
RESPONSE;
    }
}
