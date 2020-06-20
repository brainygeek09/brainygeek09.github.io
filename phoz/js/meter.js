$curlHandler = curl_init();

$token = '7883e2ec127225f478279f0cb848e3551eaaa99d484ec39cf0b77a9ccf1d9d0d';

curl_setopt_array($curlHandler, [
    CURLOPT_URL => 'https://idev.buypower.ng/v2/check/meter',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        'Accept: application/json',
        'Authorization: Bearer ' . $token
    ],
]);

$response = curl_exec($curlHandler);
curl_close($curlHandler);

print_r($response);