<?php
/**
 * Copyright (©) 2019 Company Designs LTD. All right's reserved.
 *
 * Author: Company
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 *
 * Class Index
 * @package Company\PartExchange\Controller
 */
namespace Company\PartExchange\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Area;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;
use Company\PartExchange\Helper\Data;
use Company\PartExchange\Model\ExchangeFactory;
use Company\PartExchange\Model\Mail\TransportBuilder;

/**
 * Class Index
 * @package Company\PartExchange\Controller\Index
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /** @var  Page */
    protected $resultPageFactory;
    /**
     * @var ExchangeFactory
     */
    protected $modelExchangeFactory;
    protected $resultJsonFactory;
    protected $_helper;
    protected $_storeManager;
    /**
     * @var StateInterface
     */
    protected $inlineTranslation;

    /**
     * @var TransportBuilder
     */
    protected $_transportBuilder;

    /**
     * @param Context $context
     * @param ExchangeFactory $modelExchangeFactory
     * @param JsonFactory $resultJsonFactory
     * @param PageFactory $resultPageFactory
     * @param StoreManagerInterface $storeManager
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        ExchangeFactory $modelExchangeFactory,
        JsonFactory $resultJsonFactory,
        PageFactory $resultPageFactory,
        StoreManagerInterface $storeManager,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder,
        Data $helper
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->modelExchangeFactory = $modelExchangeFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->_helper = $helper;
        $this->_storeManager = $storeManager;
        $this->inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|Page
     * @throws \Exception
     */
    public function execute()
    {
        $post = $this->getRequest()->getPost();
        if (isset($post['exchange_form'])) {
            $data = [
                'brand' => $post['brand'],
                'model' => $post['model'],
                'original_box'=> $post['original_box'],
                'original_warranty'=> $post['original_warranty'],
                'accessories'=> $post['additional_accessories'],
                'interested_buying'=> $post['interested_in_buying'],
                'paper_work_date'=> $post['paper_work_date'],
                'expected_value'=> $post['expected_value'],
                'contact_name'=> $post['contact_name'],
                'contact_phone' => $post['contact_phone'],
                'contact_email'=> $post['contact_email'],
                'exchange_product_name'=> $post['exchange_product_name']
            ];
            $exchangeModel = $this->modelExchangeFactory->create();
            $exchangeModel->setData($data);
            $exchangeModel->save();
            if (isset($post['exchange_product_name'])) {
                $resultJson = $this->resultJsonFactory->create();
                if ($exchangeModel->getId()) {
                    $this->sendMail($post);
                    $response = ['success' => 'true'];
                    $this->messageManager->addSuccessMessage(__('Your Part Exchange has been submitted.'));
                } else {
                    $response = ['error' => 'true'];
                    $this->messageManager->addErrorMessage(__('Sorry something went wrong!.'));
                }
                $resultJson->setData($response);
                return $resultJson;
            } else {
                $this->sendMail($post);
                $this->_redirect('part-exchange-a-watch/index');
                $this->messageManager->addSuccessMessage(__('Your Part Exchange has been submitted.'));
            }
        } else {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend(__('Part Exchange'));
            return $resultPage;
        }
    }
    public function sendMail($post)
    {
        $this->inlineTranslation->suspend();
        $transport = $this->_transportBuilder->setTemplateIdentifier('partexchange_template_email')
            ->setTemplateOptions(
                [
                    'area' => Area::AREA_FRONTEND,
                    'store' => $this->_storeManager->getStore()->getId(),
                ]
            )->setTemplateVars([
                'data'           => $post,
                'name' => $post['contact_name'],
                'email' => $post['contact_email']
            ])->setFrom(
                [
                    'email' => $post['contact_email'],
                    'name' => $post['contact_name']
                ]
            )->addTo(
                $this->_helper->getAdminEmailAddress(),
                $this->_helper->getAdminName()
            )->addCc($this->_helper->getEmailAddressCopy(), $this->_helper->getAdminEmailAddress())
            ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();
    }
}
