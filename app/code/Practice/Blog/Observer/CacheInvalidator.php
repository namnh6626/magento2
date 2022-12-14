<?php

namespace Practice\Blog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\PageCache\Model\Config;
use Magento\Framework\App\Cache\TypeListInterface;
use Magento\PageCache\Model\Cache\Type as CacheType;
use Practice\Blog\Helper\Cache;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Cache\Manager as CacheManager;


class CacheInvalidator implements ObserverInterface
{
    protected $typeList;
    protected $cacheManager;
    protected $config;
    protected $helperCache;
    protected $request;
    protected $cacheType;


    public function __construct(
        Config $config,
        TypeListInterface $typeList,
        CacheManager $cacheManager,
        Cache $helperCache,
        RequestInterface $request,
        CacheType $cacheType
    ) {
        $this->cacheManager = $cacheManager;
        $this->config = $config;
        $this->typeList = $typeList;
        $this->helperCache = $helperCache;
        $this->request = $request;
        $this->cacheType = $cacheType;
    }

    public function execute(Observer $observer)
    {
        $typeCodes = $observer->getTypeCode();



        if(is_array($typeCodes)){
            // if ($this->config->isEnabled()) {
            //     $this->cacheManager->clean($typeCodes);
            // }

            $this->cacheType->clean(\Zend_Cache::CLEANING_MODE_ALL, $typeCodes);

            // $this->typeList->invalidate($typeCodes);

        }else{
            return;
        }

    }
}
