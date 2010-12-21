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
	public $UserName;

	/** @var string */
	public $Password;

	/** @var string */
	public $DeveloperToken;

	/** @var array */
	private $_services = array();

	/**
	 * @param string $username
	 * @param string $password
	 * @param string $developerToken
	 */
	public function __construct($username, $password, $developerToken)
	{
		$this->UserName = $username;
		$this->Password = $password;
		$this->DeveloperToken = $developerToken;
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
