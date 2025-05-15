<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión con Google</title>
</head>
<body>
<h2>Inicia sesión con Google</h2>
<?php
$client_id = "795669465788-130u7gseomh3tcld6ptu0s6voi16gjkd.apps.googleusercontent.com";
$redirect_uri = "http://localhost:8000/auth/oauth"; // debe coincidir con lo que pusiste en Google Cloud
$scope = urlencode("email profile");
$login_url = "https://accounts.google.com/o/oauth2/v2/auth?response_type=code&client_id=$client_id&redirect_uri=$redirect_uri&scope=$scope&access_type=offline";
?>
<a href="<?= $login_url ?>">
    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Inicia sesión con Google">
</a>
</body>
</html>
