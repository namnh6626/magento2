<?php

namespace Practice\Blog\Controller\Adminhtml\Post;

use Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;
use Practice\Blog\Model\ResourceModel\Blog\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;
use Practice\Blog\Model\ResourceModel\BlogRepository;

class Delete extends Action
{
    protected $pageFactory;
    protected $blogCollectionFactory;
    protected $filter;
    protected $logger;
    protected $blogRepositoty;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CollectionFactory $blogCollectionFactory,
        Filter $filter,
        LoggerInterface $logger,
        BlogRepository $blogRepository
        )
    {
        $this->logger = $logger;
        $this->filter = $filter;
        $this->blogCollectionFactory = $blogCollectionFactory;
        $this->pageFactory = $pageFactory;
        $this->blogRepositoty = $blogRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->blogCollectionFactory->create());
            foreach ($collection as $blog) {
                $blog->delete();
            }

            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl($this->_redirect->getRefererUrl());
            $typeCacheCode = $this->blogRepository->getIdentities();

            $this->_eventManager->dispatch('invalidate_page', ['type_code'=>$typeCacheCode]);

        } catch (Exception $e) {
            $this->logger->critical($e->getMessage());
        }
        return $resultRedirect;
    }
}
