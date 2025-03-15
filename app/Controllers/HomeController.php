<?php
namespace App\Controllers;

class HomeController extends BaseController
{
	public function __invoke($request, $response)
	{
		return $this->container->get('view')->render($response, 'home/index.twig');
	}
}
