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

namespace Selise\Magazine\Controller\Adminhtml\Category;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Selise\Magazine\Model\Category;
use Selise\Magazine\Model\CategoryFactory;
use Selise\Magazine\Model\ResourceModel\Category as CategoryResource;

class Save extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Selise_Magazine::category_save';

    public function __construct(
        Context $context,
        private readonly CategoryFactory $categoryFactory,
        private readonly CategoryResource $categoryResource
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
        $isExistingCategory = $postData->category_id;

        /**
         * @var Category $category
         */
        $category = $this->categoryFactory->create();
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        if ($isExistingCategory) {
            try {
                $this->categoryResource->load($category, $postData->category_id);
                if (!$category->getData('category_id')) {
                    throw new NotFoundException(__('This record no longer exists.'));
                }
            } catch (Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                return $redirect->setPath('*/*/');
            }
        } else {
            //-- If new, build an object with the posted data to save it
            unset($postData->category_id);
        }

        $category->setData(array_merge($category->getData(), $postData->toArray()));
        try {
            $this->categoryResource->save($category);
            $this->messageManager->addSuccessMessage(__('The record has been saved.'));
        } catch (Exception) {
            $this->messageManager->addErrorMessage(__('There was a problem saving the record.'));
            return $redirect->setPath('*/*/');
        }

        //-- On success, redirect back to the admin grid
        return $redirect->setPath('*/*/index');
    }
}
