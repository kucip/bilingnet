<?php
    // SAMPLE HIT API iPaymu v2 PHP //

    $va           = '0000005234729998'; //get on iPaymu dashboard
    $secret       = 'SANDBOXB4CEEAE0-BADE-4EC1-B900-9FF754400CFA-20220227125606'; //get on iPaymu dashboard

    $url          = 'https://sandbox.ipaymu.com/api/v2/payment/direct';
    $method       = 'POST';


    $body = array(
            "name"=>"Buyer",
            "phone"=>"081999501092",
            "email"=>"wahyu@mail.com",
            "amount"=>"10000",
            "notifyUrl"=>"https://mywebsite.com",
            "expired"=>"24",
            "expiredType"=>"hours",
            "comments"=>"Catatan",
            "referenceId"=>"1",
            "paymentMethod"=>"va",
            "paymentChannel"=>"bca",
            "product"=>["produk 1"],
            "qty"=>["1"],
            "price"=>["10000"],
            "weight"=>["1"],
            "width"=>["1"],
            "height"=>["1"],
            "length"=>["1"],
            "deliveryArea"=>"76111",
            "deliveryAddress"=>"Denpasar"
        );



    //Generate Signature
    $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
    $requestBody  = strtolower(hash('sha256', $jsonBody));
    $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $secret;
    $signature    = hash_hmac('sha256', $stringToSign, $secret);
    $timestamp    = Date('YmdHis');
    //End Generate Signature

    $ch = curl_init($url);
    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
        'va: ' . $va,
        'signature: ' . $signature,
        'timestamp: ' . $timestamp
    );

    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_POST, count($body));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonBody);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $err = curl_error($ch);
    $ret = curl_exec($ch);
    curl_close($ch);

    echo $ret;

    // if($err) {
    //     echo $err;
    // } else {
    //     $ret = json_decode($ret);
    //     if($ret->Status == 200) {
    //         $sessionId  = $ret->Data->SessionID;
    //         $url        =  $ret->Data->Url;
    //         header('Location:' . $url);
    //     } else {
    //         echo $ret;
    //     }
    // }

?>