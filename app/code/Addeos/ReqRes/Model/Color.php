<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Didier Berlioz <berliozd@gmail.com>
 * @copyright Copyright (c) 2019 Addeos (http://www.addeos.com)
 */

namespace Addeos\ReqRes\Model;

use Magento\Framework\DataObject;

/**
 * Class Color
 * @package Addeos\ReqRes\Model
 */
class Color extends DataObject implements ColorInterface
{

    public function getId()
    {
        return $this->getData('id');
    }

    public function getName()
    {
        return $this->getData('name');
    }

    public function getYear()
    {
        return $this->getData('year');
    }

    public function getColor()
    {
        return $this->getData('color');
    }

    public function getPantoneValue()
    {
        return $this->getData('pantone_value');
    }
}
