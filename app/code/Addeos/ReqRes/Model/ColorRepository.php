<?php
/**
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author didier <berliozd@gmail.com>
 * @copyright Copyright (c) 2019 Addeos (http://www.addeos.com)
 */

namespace Addeos\ReqRes\Model;

use Addeos\ReqRes\Helper\Cache;
use Magento\Framework\HTTP\Client\Curl;
use Psr\Log\LoggerInterface;


class ColorRepository implements ColorRepositoryInterface
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
     * @var int $ApiCallTimeout
     */
    private $ApiCallTimeout = 2000;
    /**
     * @var ColorInterfaceFactory
     */
    private $colorInterfaceFactory;


    /**
     * @param Curl $curl
     * @param Cache $cacheHelper
     * @param LoggerInterface $logger
     * @param ColorInterfaceFactory $colorInterfaceFactory
     */
    public function __construct(
        Curl $curl,
        Cache $cacheHelper,
        LoggerInterface $logger,
        ColorInterfaceFactory $colorInterfaceFactory
    ) {
        $this->curlClient = $curl;
        $this->curlClient->setOption(CURLOPT_TIMEOUT_MS, $this->ApiCallTimeout);
        $this->cacheHelper = $cacheHelper;
        $this->logger = $logger;
        $this->colorInterfaceFactory = $colorInterfaceFactory;
    }

    /**
     * @return array
     */
    public function getList()
    {
        $list = [];
        $colorsData = $this->getColorsData();
        foreach ($colorsData as $colorData) {
            $color = $this->colorInterfaceFactory->create();
            $color->setData($colorData);
            $list[] = $color;
        }
        return $list;
    }

    /**
     * Gets colors (from cache or api call)
     *
     * @return array
     */
    private function getColorsData()
    {
        try {
            $colors = $this->cacheHelper->loadColors();
            if (false === $colors) {
                $this->logger->notice('Cache empty : calling API');
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
    private function getColorsFromApi()
    {
        $colors = false;
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
