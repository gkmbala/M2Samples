<?php
/**
 * Copyright (©) 2019 Company Designs LTD. All right's reserved.
 *
 * Author: Company
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 *
 * Class Exchange
 * @package Company\PartExchange\Model
 */
namespace Company\PartExchange\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Exchange
 * @package Company\PartExchange\Model\ResourceModel
 */
class Exchange extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('part_exchange', 'id');
    }
}