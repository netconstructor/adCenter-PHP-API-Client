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
			, "GetCampaignsByIdsRequest" => "AdCenter_GetCampaignsByIdsRequest"
			, "Campaign" => "AdCenter_Campaign"
		);
	}

	/**
	 * @param int $accountId The identifier of the account that contains the campaigns to get.
	 * @return AdCenter_Campaign[]
	 */
	public function GetCampaignsByAccountId($accountId = null)
	{
		if ($accountId === null) {
			$accountId = $this->_user->CustomerAccountId;
		}
		$response = $this->Call(
			"GetCampaignsByAccountId"
			, array(
				new SoapParam($accountId, "AccountId")
			)
		);
		return $response->Campaigns->Campaign;
	}

	/**
	 * @param array $campaignIds Array of CampaignIds to get
	 * @return AdCenter_Campaign[]
	 */
	public function GetCampaignsByIds(array $campaignIds)
	{
		$response = $this->Call(
			"GetCampaignsByIds"
			, array(
				new AdCenter_GetCampaignsByIdsRequest($this->_user->CustomerAccountId, $campaignIds)
			)
		);
		return $response->Campaigns->Campaign;
	}

}
