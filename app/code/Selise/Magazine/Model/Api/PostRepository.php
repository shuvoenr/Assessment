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

namespace Selise\Magazine\Model\Api;

use Selise\Magazine\Api\PostManagementInterface;
use Psr\Log\LoggerInterface;
use Selise\Magazine\Model\PostFactory;

class PostRepository implements PostManagementInterface
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly PostFactory $postFactory
    ){
    }
    public function getList(int $page, int $limit): string
    {
        try {
            $collection = $this->postFactory->create()->getCollection();
            $collection
                ->setOrder('post_id', 'DESC')
                ->setCurPage($page)
                ->setPageSize($limit);

            $posts = [];
            foreach ($collection as $item) {
                $posts[] = $this->getDynamicData($item);
            }

            $result = [
                'posts'        => $posts,
                'total_number' => $collection->getSize(),
                'current_page' => $collection->getCurPage(),
                'last_page'    => $collection->getLastPageNumber(),
            ];

            return json_encode($result);
        } catch (\Exception $exception) {
            return json_encode([]);
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
