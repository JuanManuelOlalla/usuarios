 <?php
session_start();

require_once '../clases/Google/autoload.php';
$cliente = new Google_Client();
$cliente->setApplicationName('ProyectoEnviarCorreo');
$cliente->setClientId('304670743598-f6luuojm498kah8fnuqarr0mmcrg918n.apps.googleusercontent.com');
$cliente->setClientSecret('ep2o5eER7ELsUJvptEEkonTk');
$cliente->setRedirectUri('https://pruebacorreo-juanmanuelolalla.c9users.io/oauth/guardar.php');
$cliente->setScopes('https://www.googleapis.com/auth/gmail.compose');
$cliente->setAccessType('offline');

if (isset($_GET['code'])) {
   $cliente->authenticate($_GET['code']);
   $_SESSION['token'] = $cliente->getAccessToken();
   $archivo = "token.conf";
   $fh = fopen($archivo, 'w') or die("error");
   fwrite($fh, $cliente->getAccessToken()); //almacenamiento del token
   fclose($fh);
}