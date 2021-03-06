<?php

namespace StGeorgeIPG;

use StGeorgeIPG\Exceptions\ResponseCodes\BankNotAvailableException;
use StGeorgeIPG\Exceptions\ResponseCodes\CardExpiredException;
use StGeorgeIPG\Exceptions\ResponseCodes\CardInvalidException;
use StGeorgeIPG\Exceptions\ResponseCodes\CustomerContactBankException;
use StGeorgeIPG\Exceptions\ResponseCodes\DeclinedSystemErrorException;
use StGeorgeIPG\Exceptions\ResponseCodes\Exception;
use StGeorgeIPG\Exceptions\ResponseCodes\InitializedException;
use StGeorgeIPG\Exceptions\ResponseCodes\InProgressException;
use StGeorgeIPG\Exceptions\ResponseCodes\InsufficientFundsException;
use StGeorgeIPG\Exceptions\ResponseCodes\InvalidClientIdException;
use StGeorgeIPG\Exceptions\ResponseCodes\InvalidDecimalPlacementException;
use StGeorgeIPG\Exceptions\ResponseCodes\InvalidRefundException;
use StGeorgeIPG\Exceptions\ResponseCodes\LocalErrors\ConnectionException;
use StGeorgeIPG\Exceptions\ResponseCodes\LocalErrors\InitializeSSLException;
use StGeorgeIPG\Exceptions\ResponseCodes\LocalErrors\NegotiateSSLException;
use StGeorgeIPG\Exceptions\ResponseCodes\LocalErrors\ProcessException;
use StGeorgeIPG\Exceptions\ResponseCodes\ServerBusyException;
use StGeorgeIPG\Exceptions\ResponseCodes\TimeoutException;
use StGeorgeIPG\Exceptions\ResponseCodes\UnableToProcessException;
use StGeorgeIPG\Exceptions\ResponseCodes\ValidationFailureException;

class ResponseUnitTest extends TestCase
{
	/**
	 * @covers \StGeorgeIPG\Response::getCode
	 * @covers \StGeorgeIPG\Response::setCode
	 */
	public function testGetSetCode_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$value = rand(0, 1000);

		$response->setCode($value);

		$this->assertEquals($value, $response->getCode());
	}

	/**
	 * @covers \StGeorgeIPG\Response::isCodeApproved
	 */
	public function testIsCodeApproved_ValidInput_True()
	{
		$response = $this->createResponse();

		$response->setCode(Response::CODE_00);

		$this->assertTrue($response->isCodeApproved());

		$response->setCode(Response::CODE_08);

		$this->assertTrue($response->isCodeApproved());

		$response->setCode(Response::CODE_77);

		$this->assertTrue($response->isCodeApproved());
	}

	/**
	 * @covers \StGeorgeIPG\Response::isCodeApproved
	 */
	public function testIsCodeApproved_InvalidInput_False()
	{
		$response = $this->createResponse();

		$response->setCode(Response::CODE_LOCAL_ERROR);

		$this->assertFalse($response->isCodeApproved());
	}

	/**
	 * @covers \StGeorgeIPG\Response::isCodeInProgress
	 */
	public function testIsCodeInProgress_ValidInput_True()
	{
		$response = $this->createResponse();

		$response->setCode(Response::CODE_IP);

		$this->assertTrue($response->isCodeInProgress());
	}

	/**
	 * @covers \StGeorgeIPG\Response::isCodeInProgress
	 */
	public function testIsCodeInProgress_InvalidInput_False()
	{
		$response = $this->createResponse();

		$response->setCode(Response::CODE_LOCAL_ERROR);

		$this->assertFalse($response->isCodeInProgress());
	}

	/**
	 * @covers \StGeorgeIPG\Response::isCodeLocalError
	 */
	public function testIsCodeLocalError_ValidInput_True()
	{
		$response = $this->createResponse();

		$response->setCode(Response::CODE_LOCAL_ERROR);

		$this->assertTrue($response->isCodeLocalError());
	}

	/**
	 * @covers \StGeorgeIPG\Response::isCodeLocalError
	 */
	public function testIsCodeLocalError_InvalidInput_False()
	{
		$response = $this->createResponse();

		$response->setCode(Response::CODE_00);

		$this->assertFalse($response->isCodeLocalError());
	}

	/**
	 * @covers \StGeorgeIPG\Response::getText
	 * @covers \StGeorgeIPG\Response::setText
	 */
	public function testGetSetText_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$value = rand(0, 1000);

		$response->setText($value);

		$this->assertEquals($value, $response->getText());
	}

	/**
	 * @covers \StGeorgeIPG\Response::getError
	 * @covers \StGeorgeIPG\Response::setError
	 */
	public function testGetSetError_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$value = rand(0, 1000);

		$response->setError($value);

		$this->assertEquals($value, $response->getError());
	}

	/**
	 * @covers \StGeorgeIPG\Response::getErrorDetail
	 * @covers \StGeorgeIPG\Response::setErrorDetail
	 */
	public function testGetSetErrorDetail_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$value = rand(0, 1000);

		$response->setErrorDetail($value);

		$this->assertEquals($value, $response->getErrorDetail());
	}

	/**
	 * @covers \StGeorgeIPG\Response::getTransactionReference
	 * @covers \StGeorgeIPG\Response::setTransactionReference
	 */
	public function testGetSetTransactionReference_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$value = rand(0, 1000);

		$response->setTransactionReference($value);

		$this->assertEquals($value, $response->getTransactionReference());
	}

	/**
	 * @covers \StGeorgeIPG\Response::getAuthCode
	 * @covers \StGeorgeIPG\Response::setAuthCode
	 */
	public function testGetSetAuthCode_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$value = rand(0, 1000);

		$response->setAuthCode($value);

		$this->assertEquals($value, $response->getAuthCode());
	}

	/**
	 * @covers \StGeorgeIPG\Response::getStan
	 * @covers \StGeorgeIPG\Response::setStan
	 */
	public function testGetSetStan_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$value = rand(0, 1000);

		$response->setStan($value);

		$this->assertEquals($value, $response->getStan());
	}

	/**
	 * @covers \StGeorgeIPG\Response::getSettlementDate
	 * @covers \StGeorgeIPG\Response::setSettlementDate
	 */
	public function testGetSetSettlementDate_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$value = rand(0, 1000);

		$response->setSettlementDate($value);

		$this->assertEquals($value, $response->getSettlementDate());
	}

	/**
	 * @covers \StGeorgeIPG\Response::isLive
	 * @covers \StGeorgeIPG\Response::setLive
	 * @covers \StGeorgeIPG\Response::isTest
	 * @covers \StGeorgeIPG\Response::setTest
	 */
	public function testIsSetLive_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$response->setLive();

		$this->assertTrue($response->isLive());
		$this->assertFalse($response->isTest());

		$response->setLive(TRUE);

		$this->assertTrue($response->isLive());
		$this->assertFalse($response->isTest());

		$response->setLive(FALSE);

		$this->assertFalse($response->isLive());
		$this->assertTrue($response->isTest());

		$response->setTest();

		$this->assertFalse($response->isLive());
		$this->assertTrue($response->isTest());

		$response->setTest(TRUE);

		$this->assertFalse($response->isLive());
		$this->assertTrue($response->isTest());

		$response->setTest(FALSE);

		$this->assertTrue($response->isLive());
		$this->assertFalse($response->isTest());
	}

	/**
	 * @covers \StGeorgeIPG\Response::mapResponseCodeToException
	 */
	public function testMapResponseCodeToException_ValidInput_InstanceOf()
	{
		$response = $this->createResponse();

		$this->assertInstanceOf(DeclinedSystemErrorException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_03)));
		$this->assertInstanceOf(CustomerContactBankException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_05)));
		$this->assertInstanceOf(CardInvalidException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_31)));
		$this->assertInstanceOf(CardExpiredException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_33)));
		$this->assertInstanceOf(CardExpiredException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_AC)));
		$this->assertInstanceOf(InsufficientFundsException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_51)));
		$this->assertInstanceOf(BankNotAvailableException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_91)));
		$this->assertInstanceOf(InvalidDecimalPlacementException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_0C)));
		$this->assertInstanceOf(InvalidClientIdException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_0M)));
		$this->assertInstanceOf(ServerBusyException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_A6)));
		$this->assertInstanceOf(InvalidRefundException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_A8)));
		$this->assertInstanceOf(TimeoutException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_AE)));
		$this->assertInstanceOf(InitializedException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_IN)));
		$this->assertInstanceOf(InProgressException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_IP)));
		$this->assertInstanceOf(ValidationFailureException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_VA)));
		$this->assertInstanceOf(UnableToProcessException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_Y3)));
		$this->assertInstanceOf(InitializeSSLException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_LOCAL_ERROR)
		                                                                                                     ->setError('Unable to initialise SSL')));
		$this->assertInstanceOf(NegotiateSSLException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_LOCAL_ERROR)
		                                                                                                    ->setError('Unable to negotiate SSL')));
		$this->assertInstanceOf(ConnectionException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_LOCAL_ERROR)
		                                                                                                  ->setError('Unable to connect to server')));
		$this->assertInstanceOf(ProcessException::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_LOCAL_ERROR)
		                                                                                               ->setError('Unable to process')));
		$this->assertInstanceOf(Exceptions\ResponseCodes\LocalErrors\Exception::class, Response::mapResponseCodeToException($response->setCode(Response::CODE_LOCAL_ERROR)
		                                                                                                                             ->setError('')));
		$this->assertInstanceOf(Exception::class, Response::mapResponseCodeToException($response->setCode(-100)));
	}

	/**
	 * @covers \StGeorgeIPG\Response::toArray
	 * @covers \StGeorgeIPG\Response::getAttributeMapping
	 */
	public function testToArray_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$response->setCode(Response::CODE_00)
		         ->setText('Test')
		         ->setError('Error')
		         ->setErrorDetail('Detail')
		         ->setTransactionReference('123')
		         ->setAuthCode('123')
		         ->setStan('Stan')
		         ->setSettlementDate('Date')
		         ->setLive();

		$attributeMapping = Response::getAttributeMapping();

		$this->assertArraySubset([
			$attributeMapping[Response::ATTRIBUTE_RESPONSE_CODE]         => $response->getCode(),
			$attributeMapping[Response::ATTRIBUTE_RESPONSE_TEXT]         => $response->getText(),
			$attributeMapping[Response::ATTRIBUTE_ERROR]                 => $response->getError(),
			$attributeMapping[Response::ATTRIBUTE_ERROR_DETAIL]          => $response->getErrorDetail(),
			$attributeMapping[Response::ATTRIBUTE_TRANSACTION_REFERENCE] => $response->getTransactionReference(),
			$attributeMapping[Response::ATTRIBUTE_AUTH_CODE]             => $response->getAuthCode(),
			$attributeMapping[Response::ATTRIBUTE_STAN]                  => $response->getStan(),
			$attributeMapping[Response::ATTRIBUTE_SETTLEMENT_DATE]       => $response->getSettlementDate(),
			'live'                                                       => $response->isLive(),
			'test'                                                       => $response->isTest(),
		], $response->toArray());
	}

	/**
	 * @covers \StGeorgeIPG\Response::toAttributeArray
	 */
	public function testToAttributeArray_ValidInput_Equals()
	{
		$response = $this->createResponse();

		$response->setCode(Response::CODE_00)
		         ->setText('Test')
		         ->setError('Error')
		         ->setErrorDetail('Detail')
		         ->setTransactionReference('123')
		         ->setAuthCode('123')
		         ->setStan('Stan')
		         ->setSettlementDate('Date')
		         ->setLive();

		$this->assertArraySubset([
			Response::ATTRIBUTE_RESPONSE_CODE         => $response->getCode(),
			Response::ATTRIBUTE_RESPONSE_TEXT         => $response->getText(),
			Response::ATTRIBUTE_ERROR                 => $response->getError(),
			Response::ATTRIBUTE_ERROR_DETAIL          => $response->getErrorDetail(),
			Response::ATTRIBUTE_TRANSACTION_REFERENCE => $response->getTransactionReference(),
			Response::ATTRIBUTE_AUTH_CODE             => $response->getAuthCode(),
			Response::ATTRIBUTE_STAN                  => $response->getStan(),
			Response::ATTRIBUTE_SETTLEMENT_DATE       => $response->getSettlementDate(),
		], $response->toAttributeArray());
	}

	/**
	 * @covers \StGeorgeIPG\Response::toAttributeArray
	 * @covers \StGeorgeIPG\Response::createFromAttributeArray
	 */
	public function testCreateFromAttributeArray_ValidInput_Equals()
	{
		$response1 = $this->createResponse();

		$response1->setCode(Response::CODE_00)
		          ->setText('Test')
		          ->setError('Error')
		          ->setErrorDetail('Detail')
		          ->setTransactionReference('123')
		          ->setAuthCode('123')
		          ->setStan('Stan')
		          ->setSettlementDate('Date')
		          ->setLive();

		$response2 = Response::createFromAttributeArray($response1->toAttributeArray());

		$this->assertEquals($response1->getCode(), $response2->getCode());
		$this->assertEquals($response1->getText(), $response2->getText());
		$this->assertEquals($response1->getError(), $response2->getError());
		$this->assertEquals($response1->getErrorDetail(), $response2->getErrorDetail());
		$this->assertEquals($response1->getTransactionReference(), $response2->getTransactionReference());
		$this->assertEquals($response1->getAuthCode(), $response2->getAuthCode());
		$this->assertEquals($response1->getStan(), $response2->getStan());
		$this->assertEquals($response1->getSettlementDate(), $response2->getSettlementDate());
	}
}