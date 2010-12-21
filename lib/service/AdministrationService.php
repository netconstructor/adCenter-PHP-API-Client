<?php

/** AdCenter_SoapClient **/
require_once dirname(__FILE__) . "/SoapClient.php";

/**
 * AdministrationService
 *
 * The Microsoft adCenter Administration API provides a set of service operations that can be used
 * to retrieve quota information.
 *
 * @author Brandon Parise <bparise@redventures.com>
 * @package adCenter-PHP-API-Client
 * @since 2010-12-20
 */
class AdCenter_Service_AdministrationService extends AdCenter_Service_SoapClient
{
	/**
	 * Gets the monthly API quota for the customer.
	 * @return int
	 */
	public function GetAssignedQuota()
	{
		$response = $this->Call(
			"GetAssignedQuota"
		);
		return $response->AssignedQuota;
	}

	/**
	 * Gets the monthly API quota balance for the customer.
	 * @return int
	 */
	public function GetRemainingQuota()
	{
		$response = $this->Call(
			"GetRemainingQuota"
		);
		return $response->RemainingQuota;
	}

	/**
	 * Class map for this Service
	 * @return array
	 */
	public function GetClassMap()
	{
		return array(
			"GetAssignedQuotaResponse" => "AdCenter_GetAssignedQuotaResponse"
			, "GetRemainingQuotaResponse" => "AdCenter_GetRemainingQuotaResponse"
		);
	}
}

class AdCenter_GetAssignedQuotaResponse
{
	/** @var int */
	public $AssignedQuota;
}

class AdCenter_GetRemainingQuotaResponse
{
	/** @var int */
	public $RemainingQuota;
}
