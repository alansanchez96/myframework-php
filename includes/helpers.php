<?php

function debuguear($var): string
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}
