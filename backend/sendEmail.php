<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require "./sendProc.php";

$inputStream = file_get_contents("php://input");
$input = json_decode($inputStream, true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sendProc = new sendProc($input);

    if ($sendProc->validate()) {
        echo trim(json_encode([
            "error" => true,
            "message" => $sendProc->message
        ]));
    } else {
        if (!$sendProc->send()) {
            echo trim(json_encode([
                "error" => false,
                "message" => $sendProc->message
            ]));
        } else {
            echo trim(json_encode([
                "error" => true,
                "message" => $sendProc->message
            ]));
        }
    }
} else {
    echo trim(json_encode([
        "error" => true,
        "message" => "Wrong method request"
    ]));
}
