<?php
/**
 * Copyright (©) 2019 Company Designs LTD. All right's reserved.
 *
 * Author: Company
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 *
 * Class BackButton
 * @package Company\PartExchange\Block
 */

namespace Company\PartExchange\Block\Adminhtml\PartExchange\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Exchange'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }

}