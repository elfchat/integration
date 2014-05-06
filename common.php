<?php

define('ELFCHAT_URL', 'http://your-domain.com/chat'); // Chat location URL.
define('ELFCHAT_KEY', 'CHANGE THIS'); // Integration Key can be found in ElfChat Configuration.


// DO NOT MODIFY NEXT CODE

function elfchat_to_utf8($str, $from)
{
    $toUtf8 = 'UTF-8';
    if (strtoupper($from) === $toUtf8) {
        return $str;
    } elseif (function_exists('mb_convert_encoding')) {
        return mb_convert_encoding($str, $toUtf8, $from);
    } elseif (function_exists('iconv')) {
        return iconv($from, $toUtf8, $str);
    } else {
        trigger_error('Can not convert to UTF-8. Install iconv or mbstring extension.', E_USER_ERROR);
    }
}

function elfchat_convert($mixed, $from)
{
    if (is_array($mixed)) {
        foreach ($mixed as &$value) {
            $value = elfchat_convert($value, $from);
        }
        return $mixed;
    } elseif (is_string($mixed)) {
        return elfchat_to_utf8($mixed, $from);
    } else {
        return $mixed;
    }
}


function elfchat_auth($user)
{
    $data = base64_encode(json_encode($user));
    $hash = sha1(sha1($data) . sha1(ELFCHAT_KEY));
    header("Location: " . ELFCHAT_URL . "/api/login/$hash/$data");
    die;
}

function elfchat_go()
{
    header("Location: " . ELFCHAT_URL . "?need-to-login=first");
    die;
}