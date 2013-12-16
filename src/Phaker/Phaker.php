<?php

namespace Phaker;

use Phaker\Request;
use Phaker\Responder\Responder;
use Phaker\Responder\ResponderNotRegistered;

class Phaker
{
    /**
     * Actions methods, "translated" from HTTP request method
     * @var string
     */
    const METHOD_INDEX  = 'index';
    const METHOD_GET    = 'get';
    const METHOD_POST   = 'post';
    const METHOD_PUT    = 'put';
    const METHOD_DELETE = 'delete';

    /**
     *
     * @var array
     */
    protected $_validMethods = array(
        self::METHOD_INDEX,
        self::METHOD_GET,
        self::METHOD_POST,
        self::METHOD_PUT,
        self::METHOD_DELETE,
    );

    /**
     *
     * @var array
     */
    protected $_registeredResponses;

    protected function _isValidMethod($method)
    {
        return in_array($method, $this->_validMethods);
    }

    /**
     *
     * @param Responder $response
     * @throws \Exception
     * @return \Phaker\Phaker
     */
    public function register(Responder $response)
    {
        if(!$this->_isValidMethod($response->getMethod())) {
            throw new \Exception('Response method is not valid');
        }

        if($this->isRegistered($response->getUrl(), $response->getMethod() )) {
            throw new \Exception('Response already registered');
        }

        $this->_registeredResponses[$response->getMethod()][$response->getUrl()] = $response;
        return $this;
    }

    /**
     *
     * @param string $url
     * @param string $method
     * @return boolean
     */
    public function isRegistered($url, $method)
    {
        return isset($this->_registeredResponses[$method]) && array_key_exists($url, $this->_registeredResponses[$method]);
    }

    public function parse(Request $request)
    {
        $responder = $this->isRegistered($request->getUrl(), $request->getMethod())
            ? $this->_registeredResponses[$request->getMethod()][$request->getUrl()]
            : new ResponderNotRegistered;

        $responder->respond();
    }
}