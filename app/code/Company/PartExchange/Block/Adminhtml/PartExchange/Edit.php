<?php
/**
 * Copyright (©) 2019 Company Designs LTD. All right's reserved.
 *
 * Author: Company
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 *
 * Class Edit
 * @package Company\PartExchange\Block
 */

namespace Company\PartExchange\Block\Adminhtml\PartExchange;

use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Registry;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * Edit constructor.
     * @param Registry $coreRegistry
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Registry $coreRegistry,
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->_coreRegistry = $coreRegistry;
    }
}
