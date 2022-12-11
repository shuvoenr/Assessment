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

namespace Selise\Magazine\Setup\Patch\Data;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Selise\Magazine\Model\ResourceModel\Post;

class InitialPosts implements DataPatchInterface
{

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param ResourceConnection $resource
     * @param TimezoneInterface $date
     */
    public function __construct(
        protected ModuleDataSetupInterface $moduleDataSetup,
        protected ResourceConnection $resource,
        protected TimezoneInterface $date
    ) {
    }

    /**
     * Get Dependencies
     *
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * Get Aliases
     *
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * Apply the Patch
     *
     * @return $this
     */
    public function apply(): self
    {
        $date = $this->date->date()->format('Y-m-d H:i:s');
        $connection = $this->resource->getConnection();
        $data = [
            [
                'post_title'    => 'What is Lorem Ipsum?',
                'post_url'      => 'what-is-lorem-ipsum',
                'post_content'  => "<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry.",
                'category_id'   => 1,
                'meta_title'    => 'What is Lorem Ipsum?',
                'meta_content'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'post_order'    => 1,
                'is_publish'    => 1,
                'is_active'     => 1,
                'published_at'  => $date
            ],
            [
                'post_title'    => 'Why do we use it?',
                'post_url'      => 'why-do-we-use-it',
                'post_content'  => "<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry.",
                'category_id'   => 2,
                'meta_title'    => 'Why do we use it?',
                'meta_content'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'post_order'    => 1,
                'is_publish'    => 1,
                'is_active'     => 1,
                'published_at'  => $date
            ],
            [
                'post_title'    => 'Where does it come from?',
                'post_url'      => 'where-does-it-come-from',
                'post_content'  => "<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry.",
                'category_id'   => 1,
                'meta_title'    => 'Where does it come from?',
                'meta_content'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'post_order'    => 1,
                'is_publish'    => 1,
                'is_active'     => 1,
                'published_at'  => $date
            ],
            [
                'post_title'    => 'Where can I get some?',
                'post_url'      => 'where-cai-i-get-some',
                'post_content'  => "<b>Lorem Ipsum</b> is simply dummy text of the printing and typesetting industry.",
                'category_id'   => 2,
                'meta_title'    => 'Where can I get some?',
                'meta_content'  => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'post_order'    => 1,
                'is_publish'    => 1,
                'is_active'     => 1,
                'published_at'  => $date
            ]
        ];
        $connection->insertMultiple(Post::MAIN_TABLE, $data);

        return $this;
    }
}
