<?php

/** All sbase service */
require_once dirname(__FILE__) . "/ServiceBase.php";

if (!class_exists("AdCenter_Campaign"))
{
	class AdCenter_Campaign
	{
	    /** @var string [AdCenter_BudgetLimitType] */
	    public $BudgetType;

	    /** @var AdCenter_CashBackInfo */
	    public $CashBackInfo;

	    /** @var AdCenter_boolean */
	    public $ConversionTrackingEnabled;

	    /** @var string */
	    public $ConversionTrackingScript;

	    /** @var double */
	    public $DailyBudget;

	    /** @var boolean */
	    public $DaylightSaving;

	    /** @var string */
	    public $Description;

	    /** @var int */
	    public $Id;

	    /** @var double */
	    public $MonthlyBudget;

	    /** @var string */
	    public $Name;

	    /** @var string[] */
	    public $NegativeKeywords;

	    /** @var string[] */
	    public $NegativeSiteUrls;

	    /** @var string [AdCenter_CampaignStatus] */
	    public $Status;

	    /** @var string */
	    public $TimeZone;

	    /**
	     * @param string [AdCenter_BudgetLimitType] $BudgetType
	     * @param AdCenter_CashBackInfo $CashBackInfo
	     * @param AdCenter_boolean $ConversionTrackingEnabled
	     * @param string $ConversionTrackingScript
	     * @param AdCenter_double $DailyBudget
	     * @param AdCenter_boolean $DaylightSaving
	     * @param string $Description
	     * @param int $Id
	     * @param AdCenter_double $MonthlyBudget
	     * @param string $Name
	     * @param string[] $NegativeKeywords
	     * @param string[] $NegativeSiteUrls
	     * @param string [AdCenter_CampaignStatus] $Status
	     * @param string $TimeZone
	     */
	    public function __construct($BudgetType = null, $CashBackInfo = null, $ConversionTrackingEnabled = null, $ConversionTrackingScript = null, $DailyBudget = null, $DaylightSaving = null, $Description = null, $Id = null, $MonthlyBudget = null, $Name = null, $NegativeKeywords = null, $NegativeSiteUrls = null, $Status = null, $TimeZone = null)
	    {
	        $this->BudgetType = $BudgetType;
	        $this->CashBackInfo = $CashBackInfo;
	        $this->ConversionTrackingEnabled = $ConversionTrackingEnabled;
	        $this->ConversionTrackingScript = $ConversionTrackingScript;
	        $this->DailyBudget = $DailyBudget;
	        $this->DaylightSaving = $DaylightSaving;
	        $this->Description = $Description;
	        $this->Id = $Id;
	        $this->MonthlyBudget = $MonthlyBudget;
	        $this->Name = $Name;
	        $this->NegativeKeywords = $NegativeKeywords;
	        $this->NegativeSiteUrls = $NegativeSiteUrls;
	        $this->Status = $Status;
	        $this->TimeZone = $TimeZone;
	    }
	}
}

if (!class_exists("AdCenter_GetCampaignsByIdsRequest"))
{
	class AdCenter_GetCampaignsByIdsRequest
	{
		/** @var int */
		public $AccountId;

		/** @var int[] */
		public $CampaignIds;

		public function __construct($AccountId = null, $CampaignIds = null)
		{
			$this->AccountId = $AccountId;
			$this->CampaignIds = $CampaignIds;
		}
	}
}

if (!class_exists("AdCenter_GetCampaignsByIdsResponse"))
{
	class AdCenter_GetCampaignsByIdsResponse
	{
	    /** @var AdCenter_Campaign[] */
	    public $Campaigns;
	}
}

if (!class_exists("AdCenter_GetCampaignsByAccountIdResponse"))
{
	class AdCenter_GetCampaignsByAccountIdResponse
	{
	    /** @var AdCenter_Campaign[] */
	    public $Campaigns;
	}
}

if (!class_exists("AdCenter_GetCampaignsInfoByAccountIdResponse"))
{
	class AdCenter_GetCampaignsInfoByAccountIdResponse
	{
	    /** @var AdCenter_Campaign[] */
	    public $CampaignsInfo;
	}
}
