<?php
/**
 * Copyright (©) 2019 Company Designs LTD. All right's reserved.
 *
 * Author: Company
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 *
 * Class Exchangeform
 * @package Company\PartExchange\Block
 */
namespace Company\PartExchange\Block;

use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class ExchangeForm
 * @package Company\PartExchange\Block
 */
class ExchangeForm extends Template
{
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $_customerSession;

    /**
     * ExchangeForm constructor.
     * @param Context $context
     * @param SessionFactory $customerSession
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        SessionFactory $customerSession,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_customerSession = $customerSession->create();
        $this->_storeManager = $storeManager;
    }

    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('part-exchange-a-watch/index');
    }

    /**
     * @return bool|\Magento\Customer\Api\Data\CustomerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getCustomerData()
    {
        if ($this->_customerSession->isLoggedIn()) {
            return $this->_customerSession->getCustomerData();
        }
        return false;
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    /**
     * @return Template
     */
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
}
