<?php
/**
 * AdCenterUser acts as the controller to the adCenter API.
 *
 * @author Brandon Parise <bparise@redventures.com>
 * @package adCenter-PHP-API-Client
 * @since 2010-12-20
 */
class AdCenterUser
{
	/** @var string */
	protected $UserName;

	/** @var string */
	protected $Password;

	/** @var string */
	protected $DeveloperToken;

	/** @var string */
	protected $CustomerAccountId;

	/** @var array */
	private $_services = array();

	/**
	 * @param string $username
	 * @param string $password
	 * @param string $developerToken
	 */
	public function __construct($username, $password, $developerToken, $customerAccountId = null)
	{
		$this->SetUserName($username);
		$this->SetPassword($password);
		$this->SetDeveloperToken($developerToken);
		$this->SetCustomerAccountId($customerAccountId);
	}

	/**
	 * @param string $username
	 */
	public function SetUserName($username)
	{
		$this->UserName = $username;
	}

	/**
	 * @return string
	 */
	public function GetUserName()
	{
		return $this->UserName;
	}

	/**
	 * @param string $password
	 */
	public function SetPassword($password)
	{
		$this->Password = $password;
	}

	/**
	 * @return string
	 */
	public function GetPassword()
	{
		return $this->Password;
	}

	/**
	 * @param string $developerToken
	 */
	public function SetDeveloperToken($developerToken)
	{
		$this->DeveloperToken = $developerToken;
	}

	/**
	 * @return string
	 */
	public function GetDeveloperToken()
	{
		return $this->DeveloperToken;
	}

	/**
	 * @param int $customerAccountId
	 */
	public function SetCustomerAccountId($customerAccountId)
	{
		$this->CustomerAccountId = $customerAccountId;
	}

	/**
	 * @return int
	 */
	public function GetCustomerAccountId()
	{
		return $this->CustomerAccountId;
	}

	/**
	 * @return AdCenter_Service_AdministrationService
	 */
	public function GetAdministrationService()
	{
		return $this->GetService(
			"AdministrationService"
			, "https://adcenterapi.microsoft.com/Api/Advertiser/v7/Administration/AdministrationService.svc?wsdl"
			, "https://adcenter.microsoft.com/v7"
		);
	}

	/**
	 * @return AdCenter_Service_CampaignManagementService
	 */
	public function GetCampaignManagementService()
	{
		return $this->GetService(
			"CampaignManagementService"
			, "https://adcenterapi.microsoft.com/Api/Advertiser/v7/CampaignManagement/CampaignManagementService.svc?wsdl"
			, "https://adcenter.microsoft.com/v7"
		);
	}

	/**
	 * @return AdCenter_Service_ReportingService
	 */
	public function GetReportingService()
	{
		return $this->GetService(
			"ReportingService"
			, "https://adcenterapi.microsoft.com/Api/Advertiser/v7/Reporting/ReportingService.svc?wsdl"
			, "https://adcenter.microsoft.com/v7"
		);
	}

	/**
	 * @param string $name
	 */
	private function GetService($name, $wsdl, $namespace)
	{
		$className = "AdCenter_Service_{$name}";
		if (!class_exists($className)) {
			require dirname(__FILE__) . "/service/{$name}.php";
		}
		if (!isset($this->_services[$name])) {
			$this->_services[$name] = new $className($this, $wsdl, $namespace);
		}
		return $this->_services[$name];
	}
}
