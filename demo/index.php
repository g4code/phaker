<?php

define('PATH_ROOT', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
require PATH_ROOT . 'vendor/autoload.php';

use Phaker\Phaker;
use Phaker\Responder\Responder;
use Phaker\Request;

$faker = new Phaker();

$responder = new Responder;
$responder
    ->setUrl('profile')
    ->setMethod(Phaker::METHOD_GET)
    ->setResponseClass('Phaker\Response\Ok')
    ->setServiceClass('Phaker\Service\Entity\FooBar');

$faker->register($responder);

$controller = isset($_GET['c']) ? $_GET['c'] : '';

$request = new Request;
$request
    ->setMethod(Phaker::METHOD_GET)
    ->setUrl($controller);

$faker->parse($request);