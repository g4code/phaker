<?php

namespace Phaker\Responder;

class ResponderNotRegistered extends ResponderAbstract
{
    /**
     *
     * @var string
     */
    protected $_responseClass = 'Phaker\Response\NotFound';

    /**
     *
     * @var string
     */
    protected $_serviceClass = 'Phaker\Service\Entity\NotFound';

}