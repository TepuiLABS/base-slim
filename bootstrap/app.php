<?php

use DI\Container;
use Dotenv\Dotenv;
use Slim\Views\Twig;
use App\Exceptions\Handler;
use App\Views\EnvExtension;
use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;
use Twig\Extension\DebugExtension;
use Psr\Http\Message\RequestInterface as Request;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

AppFactory::setContainer($container = new Container());

$app = AppFactory::create();

$container->set('view', function() use ($app) {
    $twig = Twig::create(__DIR__ . '/../resources/views', [
        'cache' => $_ENV['VIEW_CACHE_DISABLED'] === 'true' ? false : __DIR__ . '/../storage/views',
        'debug' => $_ENV['APP_ENV'] === 'local'
    ]);

    $twig->addExtension(new EnvExtension());

    if ($_ENV['APP_ENV'] === 'local') {
        $twig->addExtension(new DebugExtension());
    }

    return $twig;
});

$app->addRoutingMiddleware();

$app->add(function (Request $request, $handler) {
	$response = $handler->handle($request);

    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader(
            'Access-Control-Allow-Headers',
            'X-Requested-With, Content-Type, Accept, Origin, Authorization'
        )
        ->withHeader(
            'Access-Control-Allow-Methods',
            'GET, POST, PUT, DELETE, PATCH, OPTIONS'
        );
});

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$errorMiddleware->setDefaultErrorHandler(
	new Handler(
		$app->getResponseFactory(),
		$container->get('view')
	)
);

$app->add(TwigMiddleware::createFromContainer($app));
$app->add(new \Middlewares\TrailingSlash(false));

require_once __DIR__ .'/../routes/web.php';
require_once __DIR__ .'/database.php';