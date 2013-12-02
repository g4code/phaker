<?php

define('PATH_ROOT', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
require PATH_ROOT . 'vendor/autoload.php';

use G4\Phaker\Phaker;
use G4\Phaker\Responder\Responder;
use G4\Phaker\Request;

$faker = new Phaker();

$responder = new Responder;
$responder
    ->setUrl('profile')
    ->setMethod(Phaker::METHOD_GET)
    ->setResponseClass('G4\Phaker\Response\Ok')
    ->setServiceClass('G4\Phaker\Service\Entity\FooBar');

$faker->register($responder);

$controller = isset($_GET['c']) ? $_GET['c'] : '';

$request = new Request;
$request
    ->setMethod(Phaker::METHOD_GET)
    ->setUrl($controller);

$faker->parse($request);