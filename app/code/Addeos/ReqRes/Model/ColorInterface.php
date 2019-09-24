<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Didier Berlioz <berliozd@gmail.com>
 * @copyright Copyright (c) 2019 Addeos (http://www.addeos.com)
 */

namespace Addeos\ReqRes\Model;


Interface ColorInterface
{
    public function getId();

    public function getName();

    public function getYear();

    public function getColor();

    public function getPantoneValue();
}
