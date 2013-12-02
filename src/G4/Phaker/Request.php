<?php

namespace G4\Phaker;

class Request
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
     * @param string $value
     * @return \G4\Phaker\Request
     */
    public function setMethod($value)
    {
        $this->_method = $value;
        return $this;
    }

    /**
     *
     * @param string $value
     * @return \G4\Phaker\Request
     */
    public function setUrl($value)
    {
        $this->_url = $value;
        return $this;
    }

}