<?php

namespace Phaker;

use Phaker\Request;
use Phaker\Responder\Responder;
use Phaker\Responder\ResponderNotRegistered;

class Phaker
{
    const METHOD_GET    = 'GET';
    const METHOD_POST   = 'POST';
    const METHOD_PUT    = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /**
     *
     * @var array
     */
    protected $_validMethods = array(
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

    protected function _validMethod($method)
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
        if(!$this->_validMethod($response->getMethod())) {
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