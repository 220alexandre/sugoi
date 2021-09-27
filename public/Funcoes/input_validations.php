<?php
function validate_email($str) {
    //return preg_match(EMAIL_FORMAT, strtolower($str));
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}

function validate_alphanumeric($str) {
    return preg_match("/^[\\w-]+$/", $str);
}

function validate_number($str) {
    return preg_match("/^[\\d]+$/", $str);
}