<?php

/** All sbase service */
require_once dirname(__FILE__) . "/ServiceBase.php";

if (!class_exists("AdCenter_GetAssignedQuotaResponse"))
{
	class AdCenter_GetAssignedQuotaResponse
	{
	    /** @var int */
	    public $AssignedQuota;
	}
}

if (!class_exists("AdCenter_GetRemainingQuotaResponse"))
{
	class AdCenter_GetRemainingQuotaResponse
	{
	    /** @var int */
	    public $RemainingQuota;
	}
}
