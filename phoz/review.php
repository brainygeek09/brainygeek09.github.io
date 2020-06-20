<?php
if (isset($_GET['query']) && $_GET['query'] != '') {
  $url = 'https://api.buypower.ng/v2/check/meter';
  $query_fields = [
          'meter' => $_GET['meter'],
          'orderId' => 'true',
  ];

  $curl = curl_init($url . '?' . http_build_query($query_fields));
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Authorization: Bearer ' . $token,
  ]);
  $response = json_decode(curl_exec($curl), true);
  curl_close($curl);

  $results = $response['value'];
}
?>