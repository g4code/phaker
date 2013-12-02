<?php

namespace G4\Phaker\Response;

class NotFound extends ResponseAbstract
{
    /**
     *
     * @var int
     */
    protected $_httpCode = 404;

    /**
     *
     * @var string
     */
    protected $_httpMessage = 'Not found';


}