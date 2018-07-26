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
    $cart = json_decode($request->getCookieParam('cart', json_encode([])), true);

    // Добавление нового товара
    if (empty($cart[$item['id']])){
        $cart[$item['id']] = ['name' => $item['name'], 'count' => 1];
        $encodedCart = json_encode($cart);
        return $response->withHeader('Set-Cookie', "cart={$encodedCart}")
        ->withRedirect('/');
    }

    $cart[$item['id']]['count'] += 1;

    // Кодирование корзины
    $encodedCart = json_encode($cart);

    // Установка новой корзины в куку
    return $response->withHeader('Set-Cookie', "cart={$encodedCart}")
        ->withRedirect('/');
});

$app->delete('/cart-items', function ($request, $response, array $args) use ($repo) {
    $cart = json_decode($request->getCookieParam('cart', json_encode([])));
    $cart = [];
    $encodedCart = json_encode($cart);
    return $response->withHeader('Set-Cookie', "cart={$encodedCart}")
        ->withRedirect('/');
});

$app->run();

