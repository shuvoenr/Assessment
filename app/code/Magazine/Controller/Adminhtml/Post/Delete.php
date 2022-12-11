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
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Selise\Magazine\Model\PostFactory;
use Selise\Magazine\Model\ResourceModel\Post as PostResource;

class Delete extends Action implements HttpGetActionInterface
{
    const ADMIN_RESOURCE = 'Selise_Magazine::post_delete';

    /**
     * Delete constructor.
     * @param Context $context
     * @param PostFactory $postFactory
     * @param PostResource $postResource
     */
    public function __construct(
        Context $context,
        private readonly PostFactory $postFactory,
        private readonly PostResource $postResource
    ) {
        parent::__construct($context);
    }

    public function execute(): Redirect
    {
        try {
            $id = $this->getRequest()->getParam('post_id');
            $post = $this->postFactory->create();
            $this->postResource->load($post, $id);
            if ($post->getPostId()) {
                $this->postResource->delete($post);
                $this->messageManager->addSuccessMessage(__('The record has been deleted.'));
            } else {
                $this->messageManager->addErrorMessage(__('The record does not exist.'));
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
        }

        /** @var Redirect $redirect */
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $redirect->setPath('*/*');
    }
}
