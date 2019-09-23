<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author Didier Berlioz <berliozd@gmail.com>
 * @copyright Copyright (c) 2019 Addeos (http://www.addeos.com)
 */

namespace Addeos\ReqRes\Model;

use Addeos\ReqRes\Helper\Cache;
use Magento\Framework\HTTP\Client\Curl;
use Psr\Log\LoggerInterface;

/**
 * Class Colors
 * @package Addeos\ReqRes\Model
 */
class Colors
{
    /**
     * @var Curl
     */
    private $curlClient;

    /**
     * @var string
     */
    private $apiUrl = 'https://reqres.in/api/unknown';

    /**
     * @var Cache
     */
    private $cacheHelper;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Curl $curl
     * @param Cache $cacheHelper
     * @param LoggerInterface $logger
     */
    public function __construct(Curl $curl, Cache $cacheHelper, LoggerInterface $logger)
    {
        $this->curlClient = $curl;
        $this->cacheHelper = $cacheHelper;
        $this->logger = $logger;
    }

    /**
     * Gets colors (from cache or api call)
     *
     * @return array
     */
    public function getColors()
    {
        try {
            $colors = $this->cacheHelper->loadColors();
            if (false === $colors) {
                $colors = $this->getColorsFromApi();
                if (false === $colors) {
                    $this->logger->warning('API not returning data');
                    $colors = [];
                }
            }
            return $colors;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return [];
        }
    }

    /**
     * Calls api to get colors
     *
     * @return bool|array
     */
    protected function getColorsFromApi()
    {
        $colors = false;
        $this->logger->notice('Cache empty : calling API');
        $this->curlClient->get($this->apiUrl);
        $response = json_decode($this->curlClient->getBody(), true);
        if (isset($response['data']) && $response['data']) {
            $colors = $response['data'];
            $this->logger->notice('Saving colors in cache');
            $this->cacheHelper->saveColors($colors);
        }
        return $colors;
    }
}
