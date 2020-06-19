<?php
declare(strict_types=1);

use League\SmartPayments\Test\Fixture\TestRequest;
use Omnipay\SmartPayments\Message\Response;
use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testSuccessGetCode()
    {
        $response = $this->generateResponse($this->gatewaySuccessPurchaseResponse());
        $this->assertSame('075259', $response->getCode());
    }

    public function testSuccessGetData()
    {
        $response = $this->generateResponse($this->gatewaySuccessPurchaseResponse());
        $this->assertEqualXMLStructure(
            $this->xmlResponse($this->gatewaySuccessPurchaseResponse()),
            dom_import_simplexml($response->getData())
        );
    }

    public function testSuccessGetMessage()
    {
        $response = $this->generateResponse($this->gatewaySuccessPurchaseResponse());
        $this->assertSame('00: Approved and completed', $response->getMessage());
    }

    public function testIsSuccessful()
    {
        $response = $this->generateResponse($this->gatewaySuccessPurchaseResponse());
        $this->assertSame(true, $response->isSuccessful());
    }

    public function testSuccessGetTransactionReference()
    {
        $response = $this->generateResponse($this->gatewaySuccessPurchaseResponse());
        $this->assertSame('1299542956', $response->getTransactionReference());
    }

    public function testSuccessActionResponseCode()
    {
        $response = $this->generateResponse($this->gatewaySuccessPurchaseResponse());
        $this->assertSame('0', $response->getResponseActionCode());
    }

    public function testSuccessActionResponseMessage()
    {
        $response = $this->generateResponse($this->gatewaySuccessPurchaseResponse());
        $this->assertSame('Approved', $response->getResponseActionMessage());
    }

    private function gatewaySuccessPurchaseResponse(): string
    {
        return <<<RESPONSE
<Response xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://TPISoft.com/SmartPayments/">
    <script/>
    <Result>0</Result>
    <RespMSG>Approved</RespMSG>
    <Message>00: Approved and completed</Message>
    <AuthCode>075259</AuthCode>
    <PNRef>1299542956</PNRef>
    <HostCode>829305201575</HostCode>
    <GetAVSResult>Y</GetAVSResult>
    <GetAVSResultTXT>Address Match + 5 Zip</GetAVSResultTXT>
    <GetStreetMatchTXT>Service Not Requested</GetStreetMatchTXT>
    <GetZipMatchTXT>Service Not Requested</GetZipMatchTXT>
    <GetCommercialCard>False</GetCommercialCard>
    <ExtData>
        InvNum=WEB<ReceiptData><Approved_Amt>0.50</Approved_Amt></ReceiptData>
    </ExtData>
</Response>
RESPONSE;
    }

    private function transactionNotPermittedPurchaseResponse(): string
    {
        return <<<RESPONSE
<?xml version="1.0" encoding="utf-8"?>
<Response xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://TPISoft.com/SmartPayments/">
  <Result>12</Result>
  <RespMSG>Decline</RespMSG>
  <Message>57: Transaction not Permitted-Card</Message>
  <PNRef>3233151711</PNRef>
  <HostCode>017117405103</HostCode>
  <GetAVSResult>Y</GetAVSResult>
  <GetAVSResultTXT>Address Match + 5 Zip</GetAVSResultTXT>
  <GetStreetMatchTXT>Service Not Requested</GetStreetMatchTXT>
  <GetZipMatchTXT>Service Not Requested</GetZipMatchTXT>
  <GetCommercialCard>False</GetCommercialCard>
  <ExtData>InvNum=WEB <ReceiptData><Approved_Amt>0.00</Approved_Amt></ReceiptData></ExtData>
</Response>
RESPONSE;
    }

    private function expiredCardPurchaseResponse(): string
    {
        return <<<RESPONSE
<?xml version="1.0" encoding="utf-8"?>
<Response xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns="http://TPISoft.com/SmartPayments/">
  <Result>12</Result>
  <RespMSG>Decline</RespMSG>
  <Message>54: Expired Card</Message>
  <PNRef>3233116162</PNRef>
  <HostCode>017117400882</HostCode>
  <GetAVSResult>N</GetAVSResult>
  <GetAVSResultTXT>No Match</GetAVSResultTXT>
  <GetStreetMatchTXT>Service Not Requested</GetStreetMatchTXT>
  <GetZipMatchTXT>Service Not Requested</GetZipMatchTXT>
  <GetCommercialCard>False</GetCommercialCard>
  <ExtData>InvNum=WEB <ReceiptData><Approved_Amt>0.00</Approved_Amt></ReceiptData></ExtData>
</Response>
RESPONSE;
    }


    private function generateResponse($response_from_gateway): Response
    {
        return new Response(new TestRequest(), new SimpleXMLElement($response_from_gateway));
    }

    private function xmlResponse($response_from_gateway): DOMElement
    {
        return dom_import_simplexml(new SimpleXMLElement($response_from_gateway));
    }
}
