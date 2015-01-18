<?PHP

error_reporting(0);


require 'secretFile.php';

list($algo, $hash) = explode('=', $_SERVER['X-Hub-Signature']);
$payload = file_get_contents('php://input');
$data - json_decode($payload);

$payloadHash = hash_hmac($algo, $payload, $secret);


if ($hash[ !== $payloadHash) {
  header("HTTP/1.0 404 Not Found");
  exit;
}

echo '<pre>';
#echo exec("whoami");
echo exec("sudo salt-call --local state.sls base");
echo '</pre>';

?>
