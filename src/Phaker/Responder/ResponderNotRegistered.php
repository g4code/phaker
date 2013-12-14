<?php

namespace Phaker\Responder;

use Phaker\Response\NotFound as Response;
use Phaker\Service\Entity\NotFound as Entity;

class ResponderNotRegistered extends ResponderAbstract
{

    /**
     *
     * @return Phaker\Response\ResponseAbstract
     */
    public function respond()
    {
        $service = new Entity;

        $response = new Response();

        foreach($response->getAllHeaders() as $key => $value) {
            header(sprintf("%s: %s", $key, $value));
        }

        header(sprintf("HTTP/1.1 %d %s", $response->getHttpCode(), $response->getHttpMessage()), true, $response->getHttpCode());

        $output = array(
            'code'     => $response->getHttpCode(),
            'message'  => $response->getHttpMessage(),
            'response' => $service->getData(),
            'request'  => '',
            'version'  => '2.1.5',
        );

        echo json_encode($output, JSON_PRETTY_PRINT);
    }

}