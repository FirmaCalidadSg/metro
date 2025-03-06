

$idToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1Ni..." ; // Tu ID Token
$tokenParts = explode(".", $idToken);
$payload = base64_decode($tokenParts[1]);
$userData = json_decode($payload, true);

echo "Nombre: " . $userData['name'] . "<br>";
echo "Email: " . $userData['email'] . "<br>";