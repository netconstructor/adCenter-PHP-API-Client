<?php
/**
 * DownloadReport
 *
 * This example will use the Reporting Service to create a Keyword Performance Report request, poll
 * the request and then download the report.
 *
 * @author Brandon Parise <bparise@redventures.com>
 * @package adCenter-PHP-API-Client
 * @subpackage Examples
 * @since 2010-12-20
 */

// Define where the adCenter API Client ./lib folder
define("ADCENTER_API_CLIENT_DIR", "/path/to/adCenter-PHP-API-Client/lib");

// Authentication details.
$username = "";
$password = "";
$developerToken = "";

// AdCenterUser class
require ADCENTER_API_CLIENT_DIR . "/AdCenterUser.php";
$user = new AdCenterUser($username, $password, $developerToken);

try {
	// Get the Administration Service
	$ReportingService = $user->GetReportingService();

	// Define the columns we want for the report
	$columns = array(
		"AccountId"
		, "TimePeriod"
		, "Keyword"
		, "Clicks"
		, "Ctr"
		, "AverageCpc"
		, "Spend"
	);

	// Create our Report Request
	$KeywordPerformanceReportRequest = new AdCenter_KeywordPerformanceReportRequest();
	$KeywordPerformanceReportRequest->Aggregation = AdCenter_ReportAggregation::Daily;
	$KeywordPerformanceReportRequest->Time = new AdCenter_ReportTime(null, null, AdCenter_ReportTimePeriod::Today);
	$KeywordPerformanceReportRequest->Columns = $columns;

	// Submit the Report Request and get back the ID
	$ReportRequestId = $ReportingService->SubmitGenerateReport($KeywordPerformanceReportRequest);

	var_dump($ReportRequestId);

	// Start the polling loop
	$waitSeconds = 3; // how long to wait (seconds) between each polling
	do {
		$pollAgain = false;
		$response = $ReportingService->PollGenerateReport($ReportRequestId);
		// If we are still PENDING
		if ($response->Status == AdCenter_ReportRequestStatus::STATUS_PENDING) {
			echo "Request is " . $response->Status . ".. retrying in {$waitSeconds} seconds!" . PHP_EOL;
			sleep($waitSeconds); // wait N seconds before retrying
			$pollAgain = true;
		}
	} while ($pollAgain == true);

	// If there was an error!?
	if ($response->Status == AdCenter_ReportRequestStatus::STATUS_ERROR) {
		die("Error!");
	}

	// Get the URL to download from the response
	$reportDownloadUrl = $response->ReportDownloadUrl;

	echo "Downloading..." . PHP_EOL . $reportDownloadUrl . PHP_EOL;

	// Filename to download to
	$filename = "/tmp/test-msn-download." . time() . ".csv.zip";

	// Downoad the file into the $filename through cURL
	$handle = fopen($filename, "w");
	$ch = curl_init($reportDownloadUrl);
	curl_setopt($ch, CURLOPT_FILE, $handle);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_exec($ch);
	curl_close($ch);
	fclose($handle);

	echo "Report downloaded to {$filename}";

} catch (SoapFault $f) {
	// Eeek!
	var_dump($f);
	exit(1);
} catch (Exception $e) {
	die("Critical Error: " . $e);
}
