<?php 

require 'vendor/autoload.php'; // Importa o autoloader do Composer

use GuzzleHttp\Client;

// Cria uma instância do cliente GuzzleHttp
$client = new Client([
    // Configura a base URI da API de autenticação
    'base_uri' => 'http://179.190.39.94:18080',
]);

// Faz a requisição HTTP POST para a URL da API de autenticação
$response = $client->request('POST', '/jobintegracao/oauth/token', [
    'auth' => [
        'cprime', // substitua com o ID do seu cliente
        'c0nc3pt@api', // substitua com o segredo do seu cliente
    ],
    'form_params' => [
        'grant_type' => 'password',
        'username' => 'b2b',
        'password' => 'b2bws@cpr1m3']
]);

// Obtém o corpo da resposta e decodifica o JSON em um array
$body = json_decode($response->getBody(), true);

// Obtém o token de acesso do array de resposta
$access_token = $body['access_token'];

// Usa o token de acesso para fazer outras requisições à API protegida
// Exemplo:
$api_teste = $client->request('GET', 'jobintegracao/api/teste', [
    'headers' => [
        'Authorization' => 'Bearer ' . $access_token,
    ],
]);

$api_parceiro = $client->request('GET', 'jobintegracao/api/parceiro/3', [
    'headers' => [
        'Authorization' => 'Bearer ' . $access_token,
    ],
]);

// Exibe a resposta da API protegida
/* echo $api_teste->getBody();

echo $api_parceiro->getBody();

echo $access_token */



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h2><?= $api_teste->getBody() ?></h2>
        <h4> Acess Token: <?= $access_token ?></h2>
        <span>Response</span>
        <p><?= $api_parceiro->getBody() ?></p>
    </div>
</body>
</html>