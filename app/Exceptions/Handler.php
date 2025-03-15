<?php
namespace App\Exceptions;

use App\Helper\JsonResponse;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use Throwable;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class Handler
{

	protected $responseFactory;
	protected $view;

	/**
	 * Undocumented function
	 *
	 * @param ResponseFactoryInterface $responseFactory
	 * @param Twig $view
	 */
	public function __construct(ResponseFactoryInterface $responseFactory, Twig $view)
	{
		$this->responseFactory = $responseFactory;
		$this->view = $view;
	}


	/**
	 * Undocumented function
	 *
	 * @param  ServerRequestInterface  $request
	 * @param  Throwable  $exception  ]
	 * @return MessageInterface|ResponseInterface
	 * @throws Throwable
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	public function __invoke(ServerRequestInterface $request, Throwable $exception)
	{

		$data = [
			'success' => false,
			'message' => $exception->getMessage(),
			'code' => $exception->getCode(),
			'data' => []
		];

		if ($request->getHeader('Accept')[0] === 'application/json') {

			return JsonResponse::withJson($this->responseFactory->createResponse(), $data, $exception->getCode());
		}

		if ($exception instanceof HttpNotFoundException) {
			return $this->view->render(
				$this->responseFactory->createResponse(),
				'errors/404.twig', [
					'data' => $data
				]
			)->withStatus(404);
		}

		throw $exception;
	}
}
