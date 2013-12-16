<?php

namespace Phaker\Service\Collection;

use Phaker\Service\ServiceAbstract;

abstract class CollectionAbstract extends ServiceAbstract
{
    /**
     *
     * @var int
     */
    protected $_limit = 5;

    /**
     *
     * @var string
     */
    protected $_entityClass;

    /**
     * (non-PHPdoc)
     * @see \Phaker\Service\ServiceAbstract::getData()
     */
    public function getData()
    {
        $i = 1;
        $data = array();

        while ($i++ <= $this->_limit) {
            $entity = new $this->_entityClass;

            if( ! $entity instanceof \Phaker\Service\Entity\EntityAbstract ) {
                throw new \Exception();
            }

            $data[] = $entity->getData();
        }

        return $data;
    }


}