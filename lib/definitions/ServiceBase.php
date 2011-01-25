<?php

if (!class_exists("AdCenter_AdApiFaultDetail"))
{
	class AdCenter_AdApiFaultDetail extends AdCenter_ApplicationFault
	{
	    /** @var AdCenter_AdApiError[] */
	    public $Errors;
	}
}

if (!class_exists("AdCenter_ApplicationFault"))
{
	class AdCenter_ApplicationFault
	{
	    /** @var string */
	    public $TrackingId;
	}
}
