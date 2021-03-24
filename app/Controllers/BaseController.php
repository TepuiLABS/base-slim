<?php
namespace App\Controllers;

use DI\Container;

abstract class BaseController
{

   protected $container;

   public function __construct(Container $container)
   {
       $this->container = $container;
   }
}
