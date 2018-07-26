<?php
namespace App;

require __DIR__ . '/../vendor/autoload.php';

use function Stringy\create as s;

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
    $cart = json_decode($request->getCookieParam('cart', json_encode([])), true);
    $params = [
        'cart' => $cart
    ];
    return $this->renderer->render($response, 'index.phtml', $params);
});

$app->post('/cart-items', function ($request, $response) {
    // Информация о добавляемом товаре
    $item = $request->getParsedBodyParam('item');

    // Данные корзины
    $cart = json_decode($request->getCookieParam('cart', json_encode([])));

    // Добавление нового товара
    $cart[] = $item;

    // Кодирование корзины
    $encodedCart = json_encode($cart);

    // Установка новой корзины в куку
    return $response->withHeader('Set-Cookie', "cart={$encodedCart}")
        ->withRedirect('/');
});

$app->run();

