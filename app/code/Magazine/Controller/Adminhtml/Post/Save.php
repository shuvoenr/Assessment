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
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Selise\Magazine\Model\Post;
use Selise\Magazine\Model\PostFactory;
use Selise\Magazine\Model\ResourceModel\Post as PostResource;

class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Selise_Magazine::post_save';

    /**
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

    /**
     * Execute Function
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $postData = $this->getRequest()->getPost();
        $isExistingPost = $postData->post_id;
        /** @var Post $post */
        $post = $this->postFactory->create();
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if ($isExistingPost) {
            try {
                $this->postResource->load($post, $postData->post_id);
                if (!$post->getData('post_id')) {
                    throw new NotFoundException(__('This record no longer exists.'));
                }
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $redirect->setPath('*/*/');
            }
        } else {
            // If new, build an object with the posted data to save it
            unset($postData->post_id);
        }

        $post->setData(array_merge($post->getData(), $postData->toArray()));

        try {
            $this->postResource->save($post);
            $this->messageManager->addSuccessMessage(__('The record has been saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('There was a problem saving the record.'));
            return $redirect->setPath('*/*/');
        }

        // On success, redirect back to the admin grid
        return $redirect->setPath('*/*/index');
    }
}
