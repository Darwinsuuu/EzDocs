<?php
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsAdvancedMessage;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . "/vendor/autoload.php";

$phnumber = $_POST['pnumber'];
$msg = $_POST['message'];

$baseurl = "g96l28.api.infobip.com";
$apikey = "ab535bb7c337fe2d6110a26bc3f1bccf-f1b8efc9-96c1-4467-8775-50cf13bae145";

$conf = new Configuration(host: $baseurl, apiKey: $apikey);

$api = new SmsApi(config: $conf);

$destination = new SmsDestination(to: $phnumber);

$sendmsg = new SmsTextualMessage(
    destinations: [$destination],
    text: $msg,
    from: "EZDocs"
);

$request = new SmsAdvancedTextualRequest(messages: [$sendmsg]);

$resp = $api->sendSmsMessage($request);

header ('location: adminui/dashboard.php');
echo '<script>window.alert("Message has been sent")</script>';

?>