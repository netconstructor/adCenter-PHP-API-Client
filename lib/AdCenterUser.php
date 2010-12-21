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
	 * @param string $UserName
	 * @param string $Password
	 * @param string $DeveloperToken
	 * @param int $AccountId
	 */
	public function __construct($UserName, $Password, $DeveloperToken)
	{
		$this->UserName = $UserName;
		$this->Password = $Password;
		$this->DeveloperToken = $DeveloperToken;
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
