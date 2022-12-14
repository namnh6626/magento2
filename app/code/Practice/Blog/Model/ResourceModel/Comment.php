<?php

namespace Practice\Blog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Comment extends AbstractDb
{
    public function _construct()
    {
        $this->_init('comment_entity', 'comment_entity_id');
    }
}
