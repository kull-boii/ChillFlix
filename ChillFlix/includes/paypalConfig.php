<?php 
require_once("../PayPal-PHP-SDK/autoload.php");

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
    'AWuy7oOGy3YXhvfgcFXn4csO7x-tiJ-8uoQN4qRuqxZWboeFDID1zzLJf97BAswiaoxZRszvjHYiYt8S', // ClientID
    'EF41L-Uahg27DBZDIk0HPXM9TaLyxG0i7qmxtKoetDyoBjaKegul70bHPfn4EI9HqkoC5ey3l6hyx4qA'      // ClientSecret
    )
);
?>