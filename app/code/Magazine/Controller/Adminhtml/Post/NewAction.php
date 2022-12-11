<?php
/**
 * This source file is subject to the selise.ch for short period of time
 *
 * @category  Blog/News/Magazine
 * @package   Selise_Magazine
 * @copyright Copyright (c) Selise (https://selise.ch) for short period of time
 * @author    Suvankar Paul <shuvoenr@gmail.com>
 *
 */

declare(strict_types=1);

namespace Selise\Magazine\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class NewAction extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Selise_Magazine::post_save';

    /** @var PageFactory */
    protected $pageFactory;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    /**
     * Execute Method
     *
     * @return Page
     */
    public function execute(): Page
    {
        $page = $this->pageFactory->create();
        $page->setActiveMenu('Selise_Magazine::post');
        $page->getConfig()->getTitle()->prepend(__('New Post'));
        return $page;
    }
}
