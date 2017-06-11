<?php

namespace StGeorgeIPG;

use StGeorgeIPG\Exceptions\WebpayNotLoadedException;

/**
 * Class Webpay
 *
 * This class serves as a wrapper for the Webpay library, which helps
 * keep all of the non-IDE-findable functions in a single file.
 *
 * As it just serves as a wrapper, this file is ignored from coverage reporting.
 *
 * @package StGeorgeIPG
 * @codeCoverageIgnore
 */
class Webpay
{
	/**
	 * Webpay constructor.
	 *
	 * Checks if the Webpay extension is loaded.
	 *
	 * @throws \StGeorgeIPG\Exceptions\WebpayNotLoadedException
	 */
	public function __construct()
	{
		if (!extension_loaded('webpay')) {
			throw new WebpayNotLoadedException();
		}
	}

	/**
	 * @return mixed
	 */
	public function createBundle()
	{
		return \newBundle();
	}

	/**
	 * @param mixed $reference
	 *
	 * @return boolean
	 */
	public function executeTransaction($reference)
	{
		return \executeTransaction($reference);
	}

	/**
	 * @param mixed   $reference
	 * @param integer $clientId
	 *
	 * @return \StGeorgeIPG\Webpay
	 */
	public function setClientId($reference, $clientId)
	{
		\put_ClientID($reference, strval($clientId));

		return $this;
	}

	/**
	 * @param mixed  $reference
	 * @param string $certificatePath
	 *
	 * @return \StGeorgeIPG\Webpay
	 */
	public function setCertificatePath($reference, $certificatePath)
	{
		\put_CertificatePath($reference, realpath($certificatePath));

		return $this;
	}

	/**
	 * @param mixed  $reference
	 * @param string $certificatePassword
	 *
	 * @return \StGeorgeIPG\Webpay
	 */
	public function setCertificatePassword($reference, $certificatePassword)
	{
		\put_CertificatePassword($reference, $certificatePassword);

		return $this;
	}

	/**
	 * @param mixed    $reference
	 * @param string[] $servers
	 *
	 * @return \StGeorgeIPG\Webpay
	 */
	public function setServers($reference, $servers)
	{
		\setServers($reference, join(',', $servers));

		return $this;
	}

	/**
	 * @param mixed   $reference
	 * @param integer $port
	 *
	 * @return \StGeorgeIPG\Webpay
	 */
	public function setPort($reference, $port)
	{
		\setPort($reference, strval($port));

		return $this;
	}

	/**
	 * @param mixed  $reference
	 * @param string $name
	 *
	 * @return string
	 */
	public function getAttribute($reference, $name)
	{
		return \get($reference, $name);
	}

	/**
	 * @param mixed  $reference
	 * @param string $name
	 * @param string $value
	 *
	 * @return \StGeorgeIPG\Webpay
	 */
	public function setAttribute($reference, $name, $value)
	{
		\put($reference, $name, $value);

		return $this;
	}
}