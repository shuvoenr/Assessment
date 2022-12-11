<?php

/**
 * This source file is subject to the selise.ch for short period of time
 *
 * @category  Core Function
 * @package   Selise_Core
 * @copyright Copyright (c) Selise (https://selise.ch) for short period of time
 * @author    Suvankar Paul <shuvoenr@gmail.com>
 *
 */

declare(strict_types=1);

namespace Selise\Magazine\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Selise\Magazine\Model\PostFactory;

class PostList extends Template
{

    /**
     *
     * @param PostFactory $postFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        private readonly PostFactory $postFactory,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Get Brand Collection
     *
     * @return array
     * */
    public function getPostCollection(): array
    {
        try {
            $collection = $this->postFactory->create()->getCollection();
            $collection
                ->setOrder('post_id', 'DESC');

            $posts = [];
            foreach ($collection as $item) {
                $posts[] = $this->getDynamicData($item);
            }

            return [
                'posts'        => $posts,
                'total_number' => $collection->getSize(),
                'current_page' => $collection->getCurPage(),
                'last_page'    => $collection->getLastPageNumber(),
            ];

        } catch (\Exception $exception) {
            return [];
        }
    }

    /**
     * Get Dynamic data by key pair value
     *
     * @param $item
     * @return array
     */
    protected function getDynamicData($item): array
    {
        $data = $item->getData();
        $keys = [
            'post_id',
            'post_title',
            'post_url',
            'post_content',
            'category_id',
            'meta_title',
            'featured_img'
        ];
        foreach ($keys as $key) {
            $method = 'get' . str_replace('_', '', ucwords($key, '_'));
            $data[$key] = $item->$method();
        }
        return $data;
    }
}
