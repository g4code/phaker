<?php

namespace Phaker\Response;

class Ok extends ResponseAbstract
{
    /**
     *
     * @var int
     */
    protected $_httpCode = 200;

    /**
     *
     * @var string
     */
    protected $_httpMessage = 'OK';


}