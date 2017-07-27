<?php

namespace Shop\Framework;

class Controller
{
  private $router;
  private $config;
  private $templates;

  public function __construct( $router, $config)
  {
    $this->router = $router;
    $this->config = $config;
    // initialisez le moteur de templates ici
  }
}
 ?>
