<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Slim\App;

class BaseController {
	/**
	 * @var App
	 */
	protected $app;

	public function __construct( $app ) {
		$this->app = $app;

	}

}