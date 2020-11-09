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
namespace Company\PartExchange\Model;
use Magento\Framework\Model\AbstractModel;
/**
 * Class Exchange
 * @package Company\PartExchange\Model
 */
class Exchange extends AbstractModel
{
    /**
     * Cache tag
     *
     * @var string
     */
    const CACHE_TAG = 'part_exchange';

    /**
     * Cache tag
     *
     * @var string
     */
    protected $_cacheTag = 'part_exchange';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'part_exchange';

    protected function _construct()
    {
        $this->_init('Company\PartExchange\Model\ResourceModel\Exchange');
    }

    /**
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
