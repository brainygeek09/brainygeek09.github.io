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

  return $response;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Basic Page Needs -->
    <meta charset="UTF-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title> Phoz Renewable Energy</title>
    <!-- Author Meta -->
    <meta name="author" content="Brainy Codes Inc." url="brainycodes.com">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSS Styling -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <div class="container">  
      <form id="contact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <h3 style="text-align: center;">Buy Power From Phoz</h3>
        <fieldset>
        <input placeholder="Meter Number" type="tel" id="meter" name="meter" autocomplete="off" value="" tabindex="1" required autofocus>
        </fieldset>
        <fieldset>
        <button name="submit" type="submit" id="contact-submit" data-submit="...Sending">Confirm Your Info</button>
        </fieldset>
      </form>

      <hr>

      <?php
        if (!empty($results)) {
          echo '<b>Your Meter Info:</b>';
          foreach ($results as $post) {
              echo '<h3>' . $post['error'] . '</h3>';
              echo '<h3>' . $post['meterNo'] . '</h3>';
              echo '<h3>' . $post['orderId'] . '</h3>';
              echo '<h3>' . $post['discoCode'] . '</h3>';
              echo '<h3>' . $post['vendType'] . '</h3>';
              echo '<h3>' . $post['name'] . '</h3>';
              echo '<h3>' . $post['vendType'] . '</h3>';
              echo '<h3>' . $post['address'] . '</h3>';
              echo '<h3>' . $post['minVendAmount'] . '</h3>';
              echo '<h3>' . $post['maxVendAmount'] . '</h3>';
              echo '<hr>';
          }
        }
      ?>
      
    </div>
  </body>
</html>