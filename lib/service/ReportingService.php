<?php

/** AdCenter_SoapClient **/
require_once dirname(__FILE__) . "/SoapClient.php";

/**
 * ReportingService
 *
 * The adCenter Reporting service provides operations that you use to request predefined reports.
 * The reports provide detailed statistics about accounts, campaigns, and ad groups. The information
 * can help you track finances, measure ad performance, and adjust settings to optimize your budget
 * or campaign.
 *
 * @author Brandon Parise <bparise@redventures.com>
 * @package adCenter-PHP-API-Client
 * @since 2010-12-20
 */
class AdCenter_Service_ReportingService extends AdCenter_Service_SoapClient
{
	/**
	 * @return array
	 */
	public function GetClassMap()
	{
		return array(
			"SubmitGenerateReportRequest" => "AdCenter_SubmitGenerateReportRequest"
			, "ReportRequest" => "AdCenter_ReportRequest"
			, "AdDynamicTextPerformanceReportRequest" => "AdCenter_AdDynamicTextPerformanceReportRequest"
			, "AdDynamicTextPerformanceReportFilter" => "AdCenter_AdDynamicTextPerformanceReportFilter"
			, "AccountThroughAdGroupReportScope" => "AdCenter_AccountThroughAdGroupReportScope"
			, "AdGroupReportScope" => "AdCenter_AdGroupReportScope"
			, "CampaignReportScope" => "AdCenter_CampaignReportScope"
			, "ReportTime" => "AdCenter_ReportTime"
			, "Date" => "AdCenter_Date"
			, "KeywordPerformanceReportRequest" => "AdCenter_KeywordPerformanceReportRequest"
			, "KeywordPerformanceReportFilter" => "AdCenter_KeywordPerformanceReportFilter"
			, "DestinationUrlPerformanceReportRequest" => "AdCenter_DestinationUrlPerformanceReportRequest"
			, "DestinationUrlPerformanceReportFilter" => "AdCenter_DestinationUrlPerformanceReportFilter"
			, "TacticChannelReportRequest" => "AdCenter_TacticChannelReportRequest"
			, "TacticChannelReportFilter" => "AdCenter_TacticChannelReportFilter"
			, "AccountPerformanceReportRequest" => "AdCenter_AccountPerformanceReportRequest"
			, "AccountPerformanceReportFilter" => "AdCenter_AccountPerformanceReportFilter"
			, "AccountReportScope" => "AdCenter_AccountReportScope"
			, "CampaignPerformanceReportRequest" => "AdCenter_CampaignPerformanceReportRequest"
			, "CampaignPerformanceReportFilter" => "AdCenter_CampaignPerformanceReportFilter"
			, "AccountThroughCampaignReportScope" => "AdCenter_AccountThroughCampaignReportScope"
			, "AdGroupPerformanceReportRequest" => "AdCenter_AdGroupPerformanceReportRequest"
			, "AdGroupPerformanceReportFilter" => "AdCenter_AdGroupPerformanceReportFilter"
			, "AdPerformanceReportRequest" => "AdCenter_AdPerformanceReportRequest"
			, "AdPerformanceReportFilter" => "AdCenter_AdPerformanceReportFilter"
			, "BudgetSummaryReportRequest" => "AdCenter_BudgetSummaryReportRequest"
			, "BudgetSummaryReportTime" => "AdCenter_BudgetSummaryReportTime"
			, "AgeGenderDemographicReportRequest" => "AdCenter_AgeGenderDemographicReportRequest"
			, "AgeGenderDemographicReportFilter" => "AdCenter_AgeGenderDemographicReportFilter"
			, "MetroAreaDemographicReportRequest" => "AdCenter_MetroAreaDemographicReportRequest"
			, "MetroAreaDemographicReportFilter" => "AdCenter_MetroAreaDemographicReportFilter"
			, "PublisherUsagePerformanceReportRequest" => "AdCenter_PublisherUsagePerformanceReportRequest"
			, "PublisherUsagePerformanceReportFilter" => "AdCenter_PublisherUsagePerformanceReportFilter"
			, "SitePerformanceReportRequest" => "AdCenter_SitePerformanceReportRequest"
			, "SitePerformanceReportFilter" => "AdCenter_SitePerformanceReportFilter"
			, "BehavioralTargetReportRequest" => "AdCenter_BehavioralTargetReportRequest"
			, "BehavioralTargetReportFilter" => "AdCenter_BehavioralTargetReportFilter"
			, "BehavioralPerformanceReportRequest" => "AdCenter_BehavioralPerformanceReportRequest"
			, "BehavioralPerformanceReportFilter" => "AdCenter_BehavioralPerformanceReportFilter"
			, "SearchQueryPerformanceReportRequest" => "AdCenter_SearchQueryPerformanceReportRequest"
			, "SearchQueryPerformanceReportFilter" => "AdCenter_SearchQueryPerformanceReportFilter"
			, "ConversionPerformanceReportRequest" => "AdCenter_ConversionPerformanceReportRequest"
			, "ConversionPerformanceReportFilter" => "AdCenter_ConversionPerformanceReportFilter"
			, "GoalsAndFunnelsReportRequest" => "AdCenter_GoalsAndFunnelsReportRequest"
			, "GoalsAndFunnelsReportFilter" => "AdCenter_GoalsAndFunnelsReportFilter"
			, "TrafficSourcesReportRequest" => "AdCenter_TrafficSourcesReportRequest"
			, "TrafficSourcesReportFilter" => "AdCenter_TrafficSourcesReportFilter"
			, "SegmentationReportRequest" => "AdCenter_SegmentationReportRequest"
			, "SegmentationReportFilter" => "AdCenter_SegmentationReportFilter"
			, "SubmitGenerateReportResponse" => "AdCenter_SubmitGenerateReportResponse"
			, "ApiFaultDetail" => "AdCenter_ApiFaultDetail"
			, "BatchError" => "AdCenter_BatchError"
			, "PollGenerateReportRequest" => "AdCenter_PollGenerateReportRequest"
			, "PollGenerateReportResponse" => "AdCenter_PollGenerateReportResponse"
			, "ReportRequestStatus" => "AdCenter_ReportRequestStatus"
		);
	}

	/**
	 * @param AdCenter_ReportRequest $request
	 * @return int
	 */
	public function SubmitGenerateReport(AdCenter_ReportRequest $request)
	{
		$response = $this->Call(
			"SubmitGenerateReport"
			, array(
				new SoapParam(new AdCenter_SubmitGenerateReportRequest($request), "SubmitGenerateReportRequest")
			)
		);
		return $response->ReportRequestId;
	}

	/**
	 * @param int $request
	 * @return AdCenter_ReportRequestStatus
	 */
	public function PollGenerateReport($reportRequestId)
	{
		$response = $this->Call(
			"PollGenerateReport"
			, array(
				new SoapParam(new AdCenter_PollGenerateReportRequest($reportRequestId), "PollGenerateReportRequest")
			)
		);
		return $response->ReportRequestStatus;
	}
}

/**
 * VALUE SETS
 */
class AdCenter_ReportFormat
{
	const Csv = "Csv";
	const Tsv = "Tsv";
	const Xml = "Xml";
}

class AdCenter_ReportLanguage
{
	const English = "English";
	const French = "French";
}

class AdCenter_ReportTimePeriod
{
	const LastFourWeeks = "LastFourWeeks"; // A cumulative report for the four calendar weeks prior to today.
	const LastMonth = "LastMonth"; // A cumulative report for the previous calendar month.
	const LastSevenDays = "LastSevenDays"; // A report for the previous seven days, one row for each day.
	const LastSixMonths = "LastSixMonths"; // A cumulative report for the previous six calendar months.
	const LastThreeMonths = "LastThreeMonths"; // A cumulative report for the previous three calendar months.
	const LastWeek = "LastWeek"; // A cumulative report for the previous calendar week.
	const LastYear = "LastYear"; // A cumulative report for the previous calendar year.
	const ThisMonth = "ThisMonth"; // A cumulative report for the current calendar month.
	const ThisWeek = "ThisWeek"; // A cumulative report for the current calendar week.
	const ThisYear = "ThisYear"; // A cumulative report for the current calendar year.
	const Today = "Today"; // A cumulative report for the current day.
	const Yesterday = "Yesterday"; // A cumulative report for the previous day.
}

class AdCenter_ReportAggregation
{
	const Daily = "Daily";
	const Hourly = "Hourly";
	const Monthly = "Monthly";
	const Weekly = "Weekly";
	const Yearly = "Yearly";
	const Summary = "Summary";
}


class AdCenter_CampaignStatus
{
	const Active = "Active";
	const BudgetPaused = "BudgetPaused";
	const Cancelled = "Cancelled";
	const Deleted = "Deleted";
	const Paused = "Paused";
	const Submitted = "Submitted";
}
/**
 * REQUEST AND RESPONSES
 */

class AdCenter_SubmitGenerateReportRequest
{
	/** @var AdCenter_ReportRequest */
	public $ReportRequest;
	/** Constructor */
	public function __construct($ReportRequest = null)
	{
		$this->ReportRequest = $ReportRequest;
	}
}

class AdCenter_SubmitGenerateReportResponse
{
	/** @var string */
	public $ReportRequestId;
	/** Constructor */
	public function __construct($ReportRequestId = null)
	{
		$this->ReportRequestId = $ReportRequestId;
	}
}

class AdCenter_PollGenerateReportRequest
{
	/** @var string */
	public $ReportRequestId;
	/** Constructor */
	public function __construct($ReportRequestId = null)
	{
		$this->ReportRequestId = $ReportRequestId;
	}
}

class AdCenter_PollGenerateReportResponse
{
	/** @var ReportRequestStatus */
	public $ReportRequestStatus;
}

/**
 * DEFINITIONS
 */
class AdCenter_ReportTime
{
	/** @var Date */
	public $CustomDateRangeEnd;

	/** @var Date */
	public $CustomDateRangeStart;

	/**
	  * @var string
	  * @see AdCenter_ReportTimePeriod
	  */
	public $PredefinedTime;

	/** Constructor */
	public function __construct($CustomDateRangeEnd = null, $CustomDateRangeStart = null, $PredefinedTime = null)
	{
		$this->CustomDateRangeEnd = $CustomDateRangeEnd;
		$this->CustomDateRangeStart = $CustomDateRangeStart;
		$this->PredefinedTime = $PredefinedTime;
	}
}

class AdCenter_ReportRequest
{
	/**
	 * @var string
	 * @see AdCenter_ReportFormat
	 */
	public $Format;

	/**
	 * @var string
	 * @see AdCenter_ReportLanguage
	 */
	public $Language;

	/** @var string */
	public $ReportName;

	/** @var boolean */
	public $ReturnOnlyCompleteData;

	/** Constructor */
	public function __construct($Format = null, $Language = null, $ReportName = null, $ReturnOnlyCompleteData = null)
	{
		$this->Format = $Format;
		$this->Language = $Language;
		$this->ReportName = $ReportName;
		$this->ReturnOnlyCompleteData = $ReturnOnlyCompleteData;
	}
}

/**
 * KEYWORD PERFORMANCE REPORT DEFINITIONS AND VALUE SETS
 */
class AdCenter_KeywordPerformanceReportRequest extends AdCenter_ReportRequest
{
	/**
	 * @var string
	 * @see AdCenter_ReportAggregation
	 */
	public $Aggregation;

	/** @var string[] */
	public $Columns;

	/** @var AdCenter_KeywordPerformanceReportFilter */
	public $Filter;

	/** @var AdCenter_AccountThroughAdGroupReportScope */
	public $Scope;

	/** @var AdCenter_ReportTime */
	public $Time;

	/**
	 * @param string $Aggregation
	 * @param string[] $Columns
	 * @param string $Filter
	 * @param AdCenter_AccountThroughAdGroupReportScope $Scope
	 * @param AdCenter_ReportTime $Time
	 */
	public function __construct($Aggregation = null, array $Columns = array(), $Filter = null, $Scope = null, $Time = null, $Format = null, $Language = null, $ReportName = null, $ReturnOnlyCompleteData = null)
	{
		// Set some default values
		if ($Scope === null) {
			$Scope = new AdCenter_AccountThroughAdGroupReportScope();
		}
		parent::__construct($Format, $Language, $ReportName, $ReturnOnlyCompleteData);
		// Populate the
		$this->Aggregation = $Aggregation;
		$this->Columns = $Columns;
		$this->Filter = $Filter;
		$this->Scope = $Scope;
		$this->Time = $Time;
	}
}

class AdCenter_KeywordPerformanceReportFilter
{
	/**
	 * @var string
	 * @see AdCenter_AdDistribution
	 */
	public $AdDistribution;

	/**
	 * @var string
	 * @see AdCenter_AdType
	 */
	public $AdType;

	/**
	 * @var string
	 * @see AdCenter_MatchType
	 */
	public $BidMatchType;

	/**
	 * @var null
	 */
	public $Cashback;

	/**
	 * @var string
	 * @see AdCenter_MatchType
	 */
	public $DeliveredMatchType;

	/** @var string[] */
	public $Keywords;

	/**
	 * @var string
	 * @see AdCenter_LanguageAndRegion
	 */
	public $LanguageAndRegion;

	/** Constructor */
	public function __construct($AdDistribution = null, $AdType = null, $BidMatchType = null, $Cashback = null, $DeliveredMatchType = null, $Keywords = null, $LanguageAndRegion = null)
	{
		$this->AdDistribution = $AdDistribution;
		$this->AdType = $AdType;
		$this->BidMatchType = $BidMatchType;
		$this->Cashback = $Cashback;
		$this->DeliveredMatchType = $DeliveredMatchType;
		$this->Keywords = $Keywords;
		$this->LanguageAndRegion = $LanguageAndRegion;
	}
}

class AdCenter_AccountThroughAdGroupReportScope
{
	/** @var int[] */
	public $AccountIds;
	/** @var AdCenter_AdGroupReportScope[] */
	public $AdGroups;
	/** @var AdCenter_CampaignReportScope[] */
	public $Campaigns;
	/** Constructor */
	public function __construct($AccountIds = null, $AdGroups = null, $Campaigns = null)
	{
		$this->AccountIds = $AccountIds;
		$this->AdGroups = $AdGroups;
		$this->Campaigns = $Campaigns;
	}
}

class AdCenter_AdGroupReportScope
{
	/** @var int */
	public $ParentAccountId;
	/** @var int */
	public $ParentCampaignId;
	/** @var int */
	public $AdGroupId;
	/** Constructor */
	public function __construct($ParentAccountId = null, $ParentCampaignId = null, $AdGroupId = null)
	{
		$this->ParentAccountId = $ParentAccountId;
		$this->ParentCampaignId = $ParentCampaignId;
		$this->AdGroupId = $AdGroupId;
	}
}

class AdCenter_CampaignReportScope
{
	/** @var int */
	public $ParentAccountId;
	/** @var int */
	public $CampaignId;
	/** Constructor */
	public function __construct($ParentAccountId = null, $CampaignId = null)
	{
		$this->ParentAccountId = $ParentAccountId;
		$this->CampaignId = $CampaignId;
	}
}

class AdCenter_ReportRequestStatus
{
	const STATUS_ERROR = "Error";
	const STATUS_PENDING = "Pending";
	const STATUS_SUCCESS = "Success";

	/** @var string */
	public $ReportDownloadUrl;

	/** @var string */
	public $Status;
}

class AdCenter_CampaignPerformanceReportRequest extends AdCenter_ReportRequest
{
	/** @var ReportAggregation */
	public $Aggregation;
	/** @var ArrayOfCampaignPerformanceReportColumn */
	public $Columns;
	/** @var CampaignPerformanceReportFilter */
	public $Filter;
	/** @var AccountThroughCampaignReportScope */
	public $Scope;
	/** @var ReportTime */
	public $Time;
	/** Constructor */
	public function __construct($Aggregation = null, $Columns = null, $Filter = null, $Scope = null, $Time = null, $Format = null, $Language = null, $ReportName = null, $ReturnOnlyCompleteData = null)
	{
		parent::__construct($Format, $Language, $ReportName, $ReturnOnlyCompleteData);
		$this->Aggregation = $Aggregation;
		$this->Columns = $Columns;
		$this->Filter = $Filter;
		$this->Scope = $Scope;
		$this->Time = $Time;
	}
}

class AdCenter_CampaignPerformanceReportFilter
{
	/**
	 * @var string
	 * @see AdCenter_AdDistribution
	 */
	public $AdDistribution;

	/** @var DeviceTypeReportFilter */
	public $DeviceType;

	/**
	 * @var string
	 * @see AdCenter_CampaignStatus
	 */
	public $Status;

	/** Constructor */
	public function __construct($AdDistribution = null, $DeviceType = null, $Status = null)
	{
		$this->AdDistribution = $AdDistribution;
		$this->DeviceType = $DeviceType;
		$this->Status = $Status;
	}
}

class AdCenter_AccountThroughCampaignReportScope
{
	/** @var int[] */
	public $AccountIds;
	/** @var AdCenter_CampaignReportScope[] */
	public $Campaigns;
	/** Constructor */
	public function __construct($AccountIds = null, $Campaigns = null)
	{
		$this->AccountIds = $AccountIds;
		$this->Campaigns = $Campaigns;
	}
}


class AdCenter_AdPerformanceReportRequest extends AdCenter_ReportRequest
{
	/** @var ReportAggregation */
	public $Aggregation;
	/** @var ArrayOfAdPerformanceReportColumn */
	public $Columns;
	/** @var AdPerformanceReportFilter */
	public $Filter;
	/** @var AccountThroughAdGroupReportScope */
	public $Scope;
	/** @var ReportTime */
	public $Time;
	/** Constructor */
	public function __construct($Aggregation = null, $Columns = null, $Filter = null, $Scope = null, $Time = null, $Format = null, $Language = null, $ReportName = null, $ReturnOnlyCompleteData = null)
	{
		parent::__construct($Format, $Language, $ReportName, $ReturnOnlyCompleteData);
		$this->Aggregation = $Aggregation;
		$this->Columns = $Columns;
		$this->Filter = $Filter;
		$this->Scope = $Scope;
		$this->Time = $Time;
	}
}

class AdCenter_AdPerformanceReportFilter
{
	/** @var AdCenter_AdDistributionReportFilter */
	public $AdDistribution;
	
	/** @var AdCenter_AdTypeReportFilter */
	public $AdType;
	
	/** @var AdCenter_DeviceTypeReportFilter */
	public $DeviceType;
	
	public $LanguageAndRegion;

	public function __construct($AdDistribution = null, $AdType = null, $DeviceType = null, $LanguageAndRegion = null)
	{
		$this->AdDistribution = $AdDistribution;
		$this->AdType = $AdType;
		$this->DeviceType = $DeviceType;
		$this->LanguageAndRegion = $LanguageAndRegion;
	}
}

class AdCenter_AdDistributionReportFilter
{
	const FILTER_CONTENT = "Content";
	const FILTER_SEARCH = "Search";
}

class AdCenter_AdTypeReportFilter
{
	const FILTER_IMAGE = "Image";
	const FILTER_LOCAL = "Local";
	const FILTER_MOBILE = "Mobile";
	const FILTER_RICHAD = "RichAd";
	const FILTER_RICHMEDIA = "RichMedia";
	const FILTER_TEXT = "Text";
	const FILTER_THIRDPARTYCREATIVE = "ThirdPartyCreative";
}

class AdCenter_DeviceTypeReportFilter 
{
	const FILTER_COMPUTER = "Computer";
	const FILTER_SMARTPHONE = "SmartPhone";
	const FILTER_NONSMARTPHONE = "NonSmartPhone";
}
