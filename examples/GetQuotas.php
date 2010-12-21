<?php
/**
 * GetQuotas
 *
 * This example will use the Administration Service to get the Assigned and Remaining quotas
 * then provide the total quota used.
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
// 	Get the Administration Service
	$AdministrationService = $user->GetAdministrationService();

	// Fetch our Assigned Quota
	$assignedQuota = $AdministrationService->GetAssignedQuota();

	// Fetch our Remaining Quota
	$remainingQuota = $AdministrationService->GetRemainingQuota();

	echo "Assigned Quota: ";
	var_dump($assignedQuota);

	echo "Remaining Quota: ";
	var_dump($remainingQuota);

	// Use them to compute how much of the quota has been used
	echo "Quota Used: ";
	var_dump( ($assignedQuota - $remainingQuota) );

} catch (SoapFault $f) {
	// Eeek!
	var_dump($f);
	exit(1);
} catch (Exception $e) {
	die("Critical Error: " . $e);
}
