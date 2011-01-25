<?php

/** AdCenter_Service_SoapClient **/
require_once dirname(__FILE__) . "/SoapClient.php";

/** AdministrationService Definitions **/
require_once dirname(__FILE__) . "/../definitions/AdministrationService.php";

/**
 * AdministrationService
 *
 * The Microsoft adCenter Administration API provides a set of service operations that
 * can be used to retrieve quota information.
 *
 * @author Brandon Parise <bparise@redventures.com>
 * @package adCenter-PHP-API-Client
 * @since Thu, 06 Jan 2011 11:54:13 -0500
 */
class AdCenter_Service_AdministrationService extends AdCenter_Service_SoapClient
{
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

	/**
	 * Gets the monthly API quota for the customer.
	 * @throws AdCenter_AdApiFaultDetail
	 * @return int
	 */
	public function GetAssignedQuota()
	{
		$response = $this->Call("GetAssignedQuota"); /* @var $response AdCenter_GetAssignedQuotaResponse */
		return $response->AssignedQuota;
	}

	/**
	 * Gets the monthly API quota balance for the customer.
	 * @throws AdCenter_AdApiFaultDetail
	 * @return int
	 */
	public function GetRemainingQuota()
	{
		$response = $this->Call("GetRemainingQuota"); /* @var $response AdCenter_GetRemainingQuotaResponse */
		return $response->RemainingQuota;
	}
}
