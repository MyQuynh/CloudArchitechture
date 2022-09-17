<?php

require './vendor/autoload.php';

$ssm_clients = new Aws\Ssm\SsmClient([
    'version' => 'latest',
    'region' => 'us-east-1',
]);

$result = $ssm_clients->GetParametersByPath(['Path' => "/rmitstore"]);

$db_url = "";
$db_name = "";
$db_password = "";
$db_user = "";

foreach($result['Parameters'] as $p) {
    if ($p['Name'] == '/rmitstore/dbUrl') $db_url = $p['Value'];
    if ($p['Name'] == '/rmitstore/dbName') $db_name = $p['Value'];
    if ($p['Name'] == '/rmitstore/dbUser') $db_user  = $p['Value'];
    if ($p['Name'] == '/rmitstore/dbPassword') $db_password = $p['Value'];

}

define('DB_SERVER', $db_url);
define('DB_USERNAME', $db_user);
define('DB_PASSWORD', $db_password);
define('DB_DATABASE', $db_name);

?>