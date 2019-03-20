<?php
declare(strict_types=1);

use League\SmartPayments\Test\Fixture\TestRequest;
use Omnipay\SmartPayments\Message\Response;
use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testGetCode()
    {
        $response = $this->generateResponse();
        $this->assertSame('075259', $response->getCode());
    }

    public function testGetData()
    {
        $response = $this->generateResponse();
        $this->assertEqualXMLStructure($this->xmlResponse(), dom_import_simplexml($response->getData()));
    }

    public function testGetMessage()
    {
        $response = $this->generateResponse();
        $this->assertSame('00: Approved and completed', $response->getMessage());
    }

    public function testIsSuccessful()
    {
        $response = $this->generateResponse();
        $this->assertSame(true, $response->isSuccessful());
    }

    public function testGetTransactionReference()
    {
        $response = $this->generateResponse();
        $this->assertSame('1299542956', $response->getTransactionReference());
    }

    private function gatewayPurchaseResponse(): string
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

    private function generateResponse(): Response
    {
        return new Response(new TestRequest(), new SimpleXMLElement($this->gatewayPurchaseResponse()));
    }
    
    private function xmlResponse(): DOMElement
    {
        return dom_import_simplexml(new SimpleXMLElement($this->gatewayPurchaseResponse()));
    }
}
