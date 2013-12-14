<?php

namespace G4\Phaker\Response;

abstract class ResponseAbstract
{
    /**
     *
     * @var int
     */
    protected $_httpCode;

    /**
     *
     * @var string
     */
    protected $_httpMessage;

    /**
     *
     * @var array
     */
    protected $_headers = array();

    /**
     *
     * @var array
     */
    protected $_headersDefault = array(
        'Content-Type'  => 'application/json',
        'Cache-Control' => 'no-cache, must-revalidate',
    );

    /**
     *
     * @var string
     */
    protected $_body;

    public function getHttpCode()
    {
        return $this->_httpCode;
    }

    public function getHttpMessage()
    {
        return $this->_httpMessage;
    }

    public function getAllHeaders()
    {
        return array_merge($this->_headers, $this->_headersDefault);
    }

}
