<?php
/**
 * Copyright (©) 2019 Company Designs LTD. All right's reserved.
 *
 * Author: Company
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 *
 * Class Edit
 * @package Company\PartExchange\Controller\Adminhtml\PartExchange
 */

namespace Company\PartExchange\Controller\Adminhtml\PartExchange;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Company\PartExchange\Controller\Adminhtml\PartExchange;
use Company\PartExchange\Model\ExchangeFactory;

class Edit extends PartExchange
{
    /**
     * Page factory
     *
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Result JSON factory
     *
     * @var JsonFactory
     */
    protected $_resultJsonFactory;

    public function __construct(
        Context $context,
        ExchangeFactory $exchangeFactory,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;

        parent::__construct($context, $exchangeFactory, $coreRegistry);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface|Page
     */
    public function execute()
    {
        $exchange = $this->_initExchange();
        if ($this->getRequest()->getParam('id') && !$exchange->getId()) {
            $this->messageManager->addErrorMessage(__('This Part Exchange no longer exists.'));
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath(
                '*/*/edit',
                [
                    'id'       => $exchange->getId(),
                    '_current' => true
                ]
            );

            return $resultRedirect;
        }

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Company_PartExchange::exchange');
        $resultPage->getConfig()->getTitle()
            ->set(__('Part Exchange'))
            ->prepend($exchange->getId() ? __('Edit Part Exchange') : __('New Exchange'));

        return $resultPage;
    }
}
