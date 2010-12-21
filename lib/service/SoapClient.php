<?php
/**
 * AdCenter_Service_SoapClient
 *
 * This is the base SoapClient for all adCenter Service classes.
 *
 * @author Brandon Parise <bparise@redventures.com>
 * @package adCenter-PHP-API-Client
 * @since 2010-12-20
 */
abstract class AdCenter_Service_SoapClient extends SoapClient
{
	/**
	 * @var string
	 */
	private $_namespace;

	/**
	 * @var AdCenterUser
	 */
	private $_user;

	/**
	 * This array holds SOAP input headers that are required for each SOAP call.
	 * @var SoapHeader[]
	 */
	private $_requiredInputHeaders = array();

	/**
	 * @param AdCenterUser $user AdCenterUser Object
	 * @param string $wsdl WSDL for the service
	 * @param string $namespace
	 */
	public function __construct(AdCenterUser $user, $wsdl, $namespace)
	{
		// Set the user
		$this->_user = $user;

		// Set the namespace
		$this->_namespace = $namespace;

		// Set the input headers which are required for every adCenter SOAP call
		$this->_requiredInputHeaders = array(
			new SoapHeader($this->GetNamespace(), "UserName", $this->_user->UserName)
			, new SoapHeader($this->GetNamespace(), "Password", $this->_user->Password)
			, new SoapHeader($this->GetNamespace(), "DeveloperToken", $this->_user->DeveloperToken)
		);

		// Default class map (these are shared over all)
		$defaultClassMap = array(
			"ApplicationFault" => "AdCenter_ApplicationFault"
			, "AdApiFaultDetail" => "AdCenter_AdApiFaultDetail"
			, "AdApiError" => "AdCenter_AdApiError"
			, "ApiFault" => "AdCenter_ApiFault"
			, "OperationError" => "AdCenter_OperationError"
		);

		// Map our custom classes
		$classMap = array_merge($defaultClassMap, $this->GetClassMap());

		// Call the parent SoapClient constructor
		parent::__construct($wsdl, array(
			"trace" => true
			, "classmap" => $classMap
		));

	}

	/**
	 * This method must be overwritten in child Services because each Service will have its own
	 * set of class types that need mapped.
	 *
	 * @return array
	 * @abstract
	 */
	abstract public function GetClassMap();

	/**
	 * Perform a SOAP call
	 * @param string $method
	 * @param array $arguments
	 * @param array $inputHeaders
	 */
	public function Call($method, array $bodyElements = array(), array $inputHeaders = array())
	{
		// Merge our required input headers with any that are passed into this method
		$inputHeaders = array_merge($this->GetRequiredInputHeaders(), $inputHeaders);

		// Perform the soap call
		try {
			$result = parent::__soapCall($method, $bodyElements, null, $inputHeaders);
		} catch (SoapFault $f) {
			// At this point, we could transform the verbose exceptions into a more unified format?
			// For now, just re-throw the exception
			throw $f;
		}

		// @todo: Logging?

		return $result;
	}

	/**
	 * @return string
	 */
	public function GetNamespace()
	{
		return $this->_namespace;
	}

	/**
	 * @return array
	 */
	public function GetRequiredInputHeaders()
	{
		return $this->_requiredInputHeaders;
	}
}

class AdCenter_ApplicationFault
{
	/** @var string */
	public $TrackingId;
}

class AdCenter_AdApiFaultDetail
{
	/** @var AdCenter_AdApiError[] */
	public $Errors;
}

class AdCenter_AdApiError
{
	/** @var int */
	public $Code;
	/** @var string */
	public $Detail;
	/** @var string */
	public $ErrorCode;
	/** @var string */
	public $Message;
}

class AdCenter_ApiFault
{
	/** @var AdCenter_OperationError[] */
	public $OperationErrors;
}

class AdCenter_OperationError
{
	/** @var int */
	public $Code;
	/** @var string */
	public $Details;
	/** @var string */
	public $Message;
}