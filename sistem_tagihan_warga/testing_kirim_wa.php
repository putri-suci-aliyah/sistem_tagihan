<?php

    require_once 'vendor/autoload.php';
    use Twilio\Rest\Client;

    $sid    = "rahasia";
    $token  = "rahasiA";
    $twilio = new Client($sid, $token);
    # 6281223647830
    $message = $twilio->messages
      ->create("whatsapp:+628XXXXXXX", // to
        array(
          "from" => "whatsapp:+14XXXXXXXXXXXX",
          "body" => "TESTING CIMAHI TWILLIO"
        )
      );

print($message->sid);
