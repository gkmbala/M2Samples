<?php
/**
 * Copyright (©) 2019 Company Designs LTD. All right's reserved.
 *
 * Author: Company
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 *
 * Class PartExchange
 * @package Company\PartExchange\Controller\Adminhtml
 */

namespace Company\PartExchange\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Company\PartExchange\Model\ExchangeFactory;

abstract class PartExchange extends Action
{
    /**
     * Authorization level of a basic admin session
     */
    /*const ADMIN_RESOURCE = 'Company_';*/

    protected $exchangeFactory;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    public function __construct(
        Context $context,
        ExchangeFactory $exchangeFactory,
        Registry $coreRegistry
    ) {
        $this->exchangeFactory = $exchangeFactory;
        $this->_coreRegistry = $coreRegistry;

        parent::__construct($context);
    }


    protected function _initExchange()
    {
        $exchange = $this->exchangeFactory->create();
        $exchangeId = (int)$this->getRequest()->getParam('id');
        if ($exchangeId) {
            $exchange->load($exchangeId);
        }
        $this->_coreRegistry->register('part_exchange', $exchange);

        return $exchange;
    }
}
