<?php
header("Content-Type: application/xml");

$rawPostData = file_get_contents("php://input");

if (!$rawPostData) {
    echo "<?xml version=\"1.0\"?><response><status>Error</status><message>No XML input received</message></response>";
    exit;
}

libxml_use_internal_errors(true);
$xml = simplexml_load_string($rawPostData);

if (!$xml) {
    echo "<?xml version=\"1.0\"?><response><status>Error</status><message>Malformed XML</message></response>";
    exit;
}

$username = (string)$xml->username;
$password = (string)$xml->password;

$params = array("username" => $username, "password" => $password);
$client = new SoapClient(null, array(
    'location' => "http://localhost/soap_server.php",
    'uri' => "http://localhost/"
));

try {
    $result = $client->__soapCall("login", array($params));
    echo "<?xml version=\"1.0\"?><response><status>{$result}</status></response>";
} catch (Exception $e) {
    echo "<?xml version=\"1.0\"?><response><status>Error</status><message>" . $e->getMessage() . "</message></response>";
}
?>