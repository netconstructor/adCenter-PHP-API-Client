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
	protected $_namespace;

	/**
	 * @var AdCenterUser
	 */
	protected $_user;

	/**
	 * This array holds SOAP input headers that are required for each SOAP call.
	 * @var SoapHeader[]
	 */
	protected $_requiredInputHeaders = array();

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
			, new SoapHeader($this->GetNamespace(), "CustomerAccountId", $this->_user->CustomerAccountId)
		);

		// Default class map (these are shared over all)
		$defaultClassMap = array(
			"Date" => "AdCenter_Date"
			, "ApplicationFault" => "AdCenter_ApplicationFault"
			, "AdApiFaultDetail" => "AdCenter_AdApiFaultDetail"
			, "AdApiError" => "AdCenter_AdApiError"
			, "ApiFault" => "AdCenter_ApiFault"
			, "BatchError" => "AdCenter_BatchError"
			, "OperationError" => "AdCenter_OperationError"
		);

		// Map our custom classes
		$classMap = array_merge($defaultClassMap, $this->GetClassMap());

		// Call the parent SoapClient constructor
		parent::__construct($wsdl, array(
			"trace" => true
			, "classmap" => $classMap
			, "features" => SOAP_SINGLE_ELEMENT_ARRAYS
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

class AdCenter_AdDistribution
{
	const Content = "Content";
	const Search = "Search";
}

class AdCenter_AdType
{
	const Image = "Image";
	const Mobile = "Mobile";
	const RichMedia = "RichMedia";
	const Text = "Text";
	const ThirdPartyCreative = "ThirdPartyCreative";
}

class AdCenter_MatchType
{
	const Broad = "Broad";
	const Content = "Content";
	const Exact = "Exact";
	const Phrase = "Phrase";
}

class AdCenter_LanguageAndRegion
{
	const EnglishCanada = "EnglishCanada";
	const France = "France";
	const FrenchCanada = "FrenchCanada";
	const Singapore = "Singapore";
	const UnitedKingdom = "UnitedKingdom";
	const UnitedStates = "UnitedStates";
}

class AdCenter_Date
{
	/** @var int */
	public $Day;
	/** @var int */
	public $Month;
	/** @var int */
	public $Year;
	/** Constructor */
	public function __construct($Day = null, $Month = null, $Year = null)
	{
		$this->Day = $Day;
		$this->Month = $Month;
		$this->Year = $Year;
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

class AdCenter_BatchError
{
	/** @var int */
	public $Code;
	/** @var string */
	public $Details;
	/** @var string */
	public $ErrorCode;
	/** @var int */
	public $Index;
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
