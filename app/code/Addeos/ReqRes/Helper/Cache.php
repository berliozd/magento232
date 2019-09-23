<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Didier Berlioz <berliozd@gmail.com>
 * @copyright Copyright (c) 2019 Addeos (http://www.addeos.com)
 */

namespace Addeos\ReqRes\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Config\CacheInterface;

/**
 * Cache helper
 */
class Cache extends AbstractHelper
{
    /**
     * @var string
     */
    private $pathToColorsCacheFile = 'colors';

    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @param Context $context
     * @param CacheInterface $cache
     */
    public function __construct(
        Context $context,
        CacheInterface $cache
    ) {
        $this->cache = $cache;
        parent::__construct($context);
    }

    /**
     * Loads colors from cache
     *
     * @return array|bool|float|int|string|null
     */
    public function loadColors()
    {
        $data = $this->cache->load($this->pathToColorsCacheFile);
        if (false !== $data) {
            $data = unserialize($data);
        }
        return $data;
    }

    /**
     * Saves colors in cache
     *
     * @param string $colors
     * @return bool
     */
    public function saveColors($colors)
    {
        return $this->cache->save(serialize($colors), $this->pathToColorsCacheFile);
    }
}
