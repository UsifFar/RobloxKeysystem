<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Key system</title>
<link rel="icon" href="fav.svg" type="image/x-icon" />
</head>
<body>
    <form action="" method="POST" id="Captcha">
    <div class="g-recaptcha" data-callback="recaptchaCallback"
    data-sitekey="6LcAphEaAAAAANnDdlI4U-iPpZcs75OYSwv42R6o" id="google"></div>
    </form>
    <p id="Notif">Please check the recaptcha to get your key</p>
</body>
<script>
function recaptchaCallback() {
    document.getElementById('Captcha').submit()
}
</script>
</html>


<?php
//CHECKING FOR THE CAPTCHA AND PERFORMING THE FUNCTIONS DEPENDING ON THE CASES
if (isset($_POST['g-recaptcha-response'])){
    $secret = '6LcAphEaAAAAAPNADhYW0lVPzHvc3-gnDa3E6zDI';
    $response = $_POST['g-recaptcha-response'];
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $response . '&remoteip=' . $remoteip;
    $response = file_get_contents($url);
    $jsResponse = json_decode($response, true);
    if($jsResponse['success'] == 1 ){
        $key = keytodb(generatekey(25));
        echo '<script> document.getElementById("Notif").innerHTML = "Here is your generated key!" </script>';
        echo '<script> document.getElementById("google").style.display = "none";</script>';
        echo '<script> key = document.createElement("INPUT"); document.body.appendChild(key); key.value="' . $key . '";</script>';
    }else{
        echo '<script> document.getElementById("Notif").innerHTML = "Make sure the recaptcha is checked!" </script>';
    }
}
//CHECKING FOR THE CAPTCHA AND PERFORMING THE FUNCTIONS DEPENDING ON THE CASES




// GENERATING THE RANDOM KEY
function generatekey($length){
 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
 $charactersLength = strlen($characters);
 $randomString = '';
 for ($i = 0; $i < $length; $i++){
     $randomString .= $characters[rand(0, $charactersLength - 1)];
 }
 return $randomString;
}
// GENERATING THE RANDOM KEY



// SAVING THE KEY INTO THE DATABASE 
function keytodb($generatedkey){
    $data = file_get_contents('database.php');
    $data2 = str_replace("<?php", "",$data);
    $data3 = str_replace("?>", "",$data2);
    $data4 =  substr_replace($data3,'\'' . $generatedkey.'\'' . ',',-3,-3);
    file_put_contents('data.php', '<?php' . $data4 . '?>');
    return $generatedkey;
}
// SAVING THE KEY INTO THE DATABASE 
?>

