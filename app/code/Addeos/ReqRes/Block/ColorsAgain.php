<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Didier Berlioz <berliozd@gmail.com>
 * @copyright Copyright (c) 2019 Addeos (http://www.addeos.com)
 */

namespace Addeos\ReqRes\Block;

use Addeos\ReqRes\Model\ColorRepositoryInterface;
use Addeos\ReqRes\Model\ColorRepositoryInterfaceFactory;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Colors
 * @package Addeos\ReqRes\Block
 */
class ColorsAgain extends Template
{
    /**
     * @var ColorRepositoryInterface
     */
    private $colorRepositoryInterface;

    /**
     * Main constructor.
     * @param Context $context
     * @param ColorRepositoryInterfaceFactory $colorRepositoryInterfaceFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        ColorRepositoryInterfaceFactory $colorRepositoryInterfaceFactory,
        array $data = []
    ) {
        $this->colorRepositoryInterface = $colorRepositoryInterfaceFactory->create();
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getColors()
    {
        $colors = $this->colorRepositoryInterface->getList();
        return $colors;
    }
}
