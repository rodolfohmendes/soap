<?php
function login($params) {
    if ($params['username'] === 'admin' && $params['password'] === '123456') {
        return "OK";
    }
    return "Invalid credentials";
}

$options = array('uri' => 'http://localhost/');
$server = new SoapServer(null, $options);
$server->addFunction("login");
$server->handle();
?>