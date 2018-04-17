<?php
namespace Test\CurrencyConverter\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Shows currency converter form
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $pageFactory;

    /**
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    )
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * {@inheritDoc}
     * @see \Magento\Framework\App\ActionInterface::execute()
     */
    public function execute()
    {
        return $this->pageFactory->create();
    }

}