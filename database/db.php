<?php

// $db_params = parse_ini_file( dirname(__FILE__).'/db_params.ini', false );
require 'aws.phar';

//Get the application environment parameters from the Parameter Store.

$az = file_get_contents('http://169.254.169.254/latest/meta-data/placement/availability-zone');
$region = substr($az, 0, -1);

$ssm_client = new Aws\Ssm\SsmClient([
    'version' => 'latest',
    'region'  => $region
]);

$result = $ssm_client->GetParametersByPath(['Path' => '/guestbook']);

$db_url = "";
$db_name = "";
$db_user = "";
$db_password = "";

foreach($result['Parameters'] as $p) {
    if ($p['Name'] == '/guestbook/db-endpoint') $db_url = $p['Value'];
    if ($p['Name'] == '/guestbook/db-name') $db_name = $p['Value'];
    if ($p['Name'] == '/guestbook/db-user') $db_user = $p['Value'];
    if ($p['Name'] == '/guestbook/db-pass') $db_password = $p['Value'];
}


try {
//     $conn = new mysqli('localhost', 'root', '', 'guestbook');
	$conn = new mysqli($db_url, $db_user, $db_password, $db_name);
} catch (Exception $e) {
	echo 'Connection failed';
}
