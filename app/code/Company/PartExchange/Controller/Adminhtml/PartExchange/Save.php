<?php
/**
 * Copyright (©) 2019 Company Designs LTD. All right's reserved.
 *
 * Author: Company
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 *
 * Class Save
 * @package Company\PartExchange\Controller\Adminhtml\PartExchange
 */
namespace Company\PartExchange\Controller\Adminhtml\PartExchange;

use Exception;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Auth\Session;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\Filter\Date;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Company\PartExchange\Controller\Adminhtml\PartExchange;
use Company\PartExchange\Model\ExchangeFactory;

class Save extends PartExchange
{
    /**
     * Date filter
     *
     * @var Date
     */
    protected $_dateFilter;

    /**
     * @var Session
     */
    protected $_authSession;

    /**
     * @var TimezoneInterface
     */
    protected $_date;

    public function __construct(
        Context $context,
        ExchangeFactory $exchangeFactory,
        Registry $coreRegistry,
        Date $dateFilter,
        Session $authSession,
        TimezoneInterface $date
    ) {
        $this->_dateFilter = $dateFilter;
        $this->_authSession = $authSession;
        $this->_date = $date;
        parent::__construct($context, $exchangeFactory, $coreRegistry);
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data = $this->getRequest()->getParams()) {
            $exchange = $this->_initExchange();

            try {
                $exchange->addData($data['exchange'])
                    ->save();
                $this->messageManager->addSuccessMessage(__('The Exchange has been saved.'));

                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath('*/*/edit', ['id' => $exchange->getId(), '_current' => true]);

                    return $resultRedirect;
                }
            } catch (Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Exchange. %1', $e->getMessage()));
                $resultRedirect->setPath('*/*/edit', [
                    'id'       => $exchange->getId(),
                    '_current' => true
                ]);

                return $resultRedirect;
            }
        }

        $resultRedirect->setPath('*/*/');

        return $resultRedirect;
    }


}
