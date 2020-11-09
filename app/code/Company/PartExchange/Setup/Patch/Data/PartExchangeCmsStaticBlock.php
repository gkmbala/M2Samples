<?php
/**
* Copyright (©) 2019 Company Designs LTD. All right's reserved.
 *
 * Author: Company
 * Code Release Version: 1.0
 * Website: http://www.sample.co.uk
 *
 * Class PartExchangeCmsStaticBlock
 * @package Company\PartExchange\Setup\Patch\Data
 */

namespace Company\PartExchange\Setup\Patch\Data;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class PartExchangeCmsStaticBlock
 * @package Company\PartExchange\Setup\Patch\Data
 */
class PartExchangeCmsStaticBlock implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var BlockFactory
     */
    private $blockFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param BlockFactory $blockFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        BlockFactory $blockFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->blockFactory = $blockFactory;
    }

    /**
     * {@inheritdoc}
     * @throws \Exception
     */
    public function apply()
    {
        $contentHtml = '<div class="std"><p>One of the most important aspects of our business is the ability to allow 
customers to up or down grade watches. Part exchange allows us to buy your watch and off set it against a new one or for
 another preowned watch from stock. We offer several different options please see below.</p>
<p><strong>Why should you choose Iconic Watches to part ex your watch ?</strong></p>
<ol>
<li>Iconic Watches sell watches through numerous marketing channels. This means that your watch will have exposure to a 
large,&nbsp; diverse, international client base, this in turn means that you are likely to get a much higher price that 
selling your watch elsewhere</li>
<li>Iconic Watches have been trading new and used watches for over 70 years and have an excellent reputation in the 
industry,</li>
<li>All Pre-Owned watches that we sell come with an iconic watches 1 year guarantee at our expense. Again this means 
that you can get a higher return selling your watch as it is sold with warranty.</li>
</ol>
<p><strong>Option 1 Part Exchange sale</strong></p>
<p>Please fill in the below form we will email you back a rough valuation based on the description that you give, 
if you have some photographs this can help us give a more accurate quote. If you are happy with the valuation put the 
watch in the post to us: at the following address Ancient &amp; Modern, 17 New Market Street, Blackburn, Lancashire, 
BB1 7DR and then for a straight sale we will send you a cheque out next day - or alternatively we can put the money 
towards another watch on the site!</p>
<p><strong>Option 2 Commission based sale - On average you will get 20% more with a commission based sale than you 
will get from a straight sale!</strong></p>
<p>Again fill in the form below and we will tell you what price we think we can get you for your watch based on its 
description.</p>
<p>Assuming you are happy with the valuation we offer then you can send us your watch and we will book it into our 
stock, we will then have the watch professionally assessed and our sales director will identify any action that can be 
taken to increase the selling price of the watch, such as polishing, replacing broken parts etc. Assuming that you 
agree to sell at the agreed price we will go ahead with having the watch professionally photographed and listed on the 
Iconic Watches Site. As soon as the watch is sold and approved by the new owner we will transfer you the selling price 
less any pre-agreed costs and less our commission rate (usually 10% although negotiable on higher value items and a
minimum of £400 on lower value items) or we can put that value towards another watch on our site - your choice!</p>
</div>';
        $partExchangeCmsStaticBlock = [
            'title' => 'PART EXCHANGE A WATCH',
            'identifier' => 'part_exchange',
            'content' => $contentHtml,
            'is_active' => 1,
            'stores' => [0],
            'sort_order' => 0
        ];

        $this->moduleDataSetup->startSetup();

        /** @var \Magento\Cms\Model\Block $block */
        $block = $this->blockFactory->create();
        $block->setData($partExchangeCmsStaticBlock)->save();

        $this->moduleDataSetup->endSetup();
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
