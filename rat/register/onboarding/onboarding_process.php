<?php

session_start();

require_once "../../../alerts/functions.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect_with_error_alert('Method not allowed', '../');
}

require_once "../../../auth-guards.php";
auth_not_required_guard("/rat");

var_dump($_POST);
