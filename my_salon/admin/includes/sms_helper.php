<?php
function sendSalonSMS($phone, $message){
    $apiKey = "pTmOu4dSNzD5snfLGQV1KcHIERZhkijtvxJa329ew678l0qoWrjVOZpbeAD5uGtw4q3ySdWIiN7Tg6xJ"; 
    
    $fields = array(
        "message" => $message,
        "language" => "english",
        "route" => "q",
        "numbers" => $phone,
    );

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => json_encode($fields),
      CURLOPT_HTTPHEADER => array(
        "authorization: $apiKey",
        "content-type: application/json"
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}
?>