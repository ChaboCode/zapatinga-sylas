<?php
include_once('vendor/autload.php');
include_once('constants.php');

use Firebase\JWT\JWT;

function isValidJWT($jwt) {
    try {
        $decoded_jwt = JWT::decode($jwt, $jwt_secret, array('HS256'));
	return true;
    } catch (UnexcpectedValueExpression $e) {
        echo $e->getMessage();
	return false;
    }
}

