<?php
/**
 * Copyright (©) 2020 Company Designs LTD. All right's reserved.
 *
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 */
namespace Company\PartExchange\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 * @package Company\PartExchange\Helper
 */
class Data extends AbstractHelper
{
    protected $_inlineTranslation;
    protected $_transportBuilder;
    protected $_scopeConfig;
    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        TransportBuilder $transportBuilder,
        ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->_inlineTranslation = $inlineTranslation;
        $this->_transportBuilder = $transportBuilder;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context);
    }

    public function getEmailAddressCopy()
    {
        return $this->scopeConfig->getValue(
            'partexchange/general/emailaddress',
            ScopeConfigInterface::SCOPE_TYPE_DEFAULT
        );
    }
    public function getAdminEmailAddress()
    {
        return $this->_scopeConfig->getValue(
            'trans_email/ident_general/email',
            ScopeInterface::SCOPE_STORE
        );
    }
    public function getAdminName()
    {
        return $this->_scopeConfig->getValue(
            'trans_email/ident_general/name',
            ScopeInterface::SCOPE_STORE
        );
    }

}
