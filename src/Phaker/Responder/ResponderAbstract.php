<?php

namespace Phaker\Responder;

use Phaker\Service\Entity\EntityAbstract;

abstract class ResponderAbstract
{
    /**
     *
     * @var string
     */
    protected $_method;

    /**
     *
     * @var string
     */
    protected $_url;

    /**
     *
     * @var string
     */
    protected $_responseClass;

    /**
     *
     * @var string
     */
    protected $_serviceClass;

    /**
     *
     * @var array
     */
    protected $_serviceArguments;

    /**
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->_method;
    }

    /**
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     *
     * @return ResponseAbstract
     */
    public function getResponseClass()
    {
        return $this->_responseClass;
    }

    /**
     *
     * @return ServiceAbstract
     */
    public function getServiceClass()
    {
        return $this->_serviceClass;
    }

    /**
     *
     * @return array
     */
    public function getServiceArguments()
    {
        return $this->_serviceArguments;
    }

    /**
     *
     * @param string $value
     * @return \Phaker\Responder
     */
    public function setMethod($value)
    {
        $this->_method = $value;
        return $this;
    }

    /**
     *
     * @param string $value
     * @return \Phaker\Responder
     */
    public function setUrl($value)
    {
        $this->_url = $value;
        return $this;
    }

    /**
     *
     * @param string $value
     * @return \Phaker\Responder
     */
    public function setResponseClass($value)
    {
        $this->_responseClass = $value;
        return $this;
    }

    /**
     *
     * @param string $value
     * @return \Phaker\Responder
     */
    public function setServiceClass($value)
    {
        $this->_serviceClass = $value;
        return $this;
    }

    /**
     *
     * @param array $value
     * @return \Phaker\Responder
     */
    public function setServiceArguments($value)
    {
        $this->_serviceArguments = $value;
        return $this;
    }

    /**
     *
     * @return Phaker\Response\ResponseAbstract
     */
    public function respond()
    {
        $serviceClass = $this->getServiceClass();
        $service = new $serviceClass($this->getServiceArguments());

        $responseClass = $this->getResponseClass();
        $response = new $responseClass;

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