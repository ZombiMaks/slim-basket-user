<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

$repo = new Repository();

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$app = new \Slim\App($configuration);

$container = $app->getContainer();
$container['renderer'] = new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');

$app->get('/', function ($request, $response) {
    
    $params = [
        'user' => $_SESSION['user']
        
    ];
    
     return $this->renderer->render($response, 'index.phtml', $params);
 });
 
 $app->post('/session', function ($request, $response) {
 
     // Информация о добавляемом пользователе
     $user = $request->getParsedBodyParam('user');
 
     // Добавление нового пользователя
         $_SESSION['user'] = $user;
    
    return $response->withRedirect('/');
 });
 
 $app->delete('/session', function ($request, $response) {
     
     session_unset();
     session_destroy();
 
     return $response->withRedirect('/');
 });

$app->run();

