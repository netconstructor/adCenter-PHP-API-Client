<?php

/** AdCenter_Service_SoapClient **/
require_once dirname(__FILE__) . "/SoapClient.php";

/** AdministrationService Definitions **/
require_once dirname(__FILE__) . "/../definitions/CampaignManagementService.php";

/**
 * CampaignManagementService
 *
 * Description goes here...
 *
 * @author Brandon Parise <bparise@redventures.com>
 * @package adCenter-PHP-API-Client
 * @since Thu, 06 Jan 2011 16:16:55 -0500
 */
class AdCenter_Service_CampaignManagementService extends AdCenter_Service_SoapClient
{
	/**
	 * This method must be overwritten in child Services because each Service will have its own
	 * set of class types that need mapped.
	 *
	 * @return array
	 * @abstract
	 */
	public function GetClassMap()
	{
		return array(
			"GetCampaignsByAccountIdResponse" => "AdCenter_GetCampaignsByAccountIdResponse"
			, "GetCampaignsByIdsResponse" => "AdCenter_GetCampaignsByIdsResponse"
			, "Campaign" => "AdCenter_Campaign"
		);
	}

	/**
	 * @param int $accountId The identifier of the account that contains the campaigns to get.
	 * @return AdCenter_Campaign[]
	 */
	public function GetCampaignsByAccountId($accountId)
	{
		$response = $this->Call(
			"GetCampaignsByAccountId"
			, array(
				"AccountId" => $accountId
			)
		);
		return (isset($response->Campaigns->Campaign[0]) ? $response->Campaigns->Campaign : array($response->Campaigns->Campaign));
	}

}
