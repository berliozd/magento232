<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Didier Berlioz <berliozd@gmail.com>
 * @copyright Copyright (c) 2019 Addeos (http://www.addeos.com)
 */

namespace Addeos\ReqRes\Block;

use Addeos\ReqRes\Model\Colors as ColorsModel;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Colors
 * @package Addeos\ReqRes\Block
 */
class Colors extends Template
{
    /**
     * @var ColorsModel
     */
    private $colorsModel;

    /**
     * Main constructor.
     * @param Context $context
     * @param ColorsModel $colorsModel
     * @param array $data
     */
    public function __construct(Context $context, ColorsModel $colorsModel, array $data = [])
    {
        $this->colorsModel = $colorsModel;
        parent::__construct($context, $data);
    }

    /**
     * Return color names
     * @return array
     */
    public function getColorNames()
    {
        $colorNames = [];
        foreach ($this->colorsModel->getColors() as $color) {
            if (isset($color['name'])) {
                $colorNames[] = $color['name'];
            }
        }
        return $colorNames;
    }
}
