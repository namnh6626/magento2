<?php

namespace Practice\Blog\Model\ResourceModel\BlogNotification;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Practice\Blog\Api\Data\BlogInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class Collection extends AbstractCollection
{
    protected $table;
    protected function _construct()
    {
        $this->_init('Practice\Blog\Model\BlogNotification', 'Practice\Blog\Model\ResourceModel\BlogNotification');

    }



}
