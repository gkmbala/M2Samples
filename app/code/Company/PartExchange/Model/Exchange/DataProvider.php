<?php
/**
 * Copyright (©) 2019 Company Designs LTD. All right's reserved.
 *
 * Author: Company
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 *
 * Class DataProvider
 * @package Company\PartExchange\Model
 */
namespace Company\PartExchange\Model\Exchange;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Company\PartExchange\Model\ResourceModel\Exchange\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $exchangeCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $exchangeCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = [];
        foreach ($items as $exchange) {
            $this->loadedData[$exchange->getId()]['exchange'] = $exchange->getData();
        }

        return $this->loadedData;
    }
}
