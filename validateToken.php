<?php
include_once('vendor/autoload.php');

use Firebase\JWT\JWT;

function isValidJWT($jwt) {
    include('./constants.php');

    try {
        $decoded_jwt = JWT::decode($jwt, $jwt_secret, array('HS256'));
	return true;
    } catch (UnexcpectedValueExpression $e) {
        echo $e->getMessage();
	return false;
    }
}

