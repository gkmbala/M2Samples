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
namespace Company\PartExchange\Model\ResourceModel\Exchange;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Company\PartExchange\Model\ResourceModel\Exchange
 */
class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'partexchange_collection';
    protected $_eventObject = 'exchange_collection';
    protected function _construct()
    {
        $this->_init('Company\PartExchange\Model\Exchange', 'Company\PartExchange\Model\ResourceModel\Exchange');
    }
}
