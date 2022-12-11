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
use Selise\Magazine\Model\ResourceModel\Category;

class InitialCategory implements DataPatchInterface
{

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param ResourceConnection $resource
     */
    public function __construct(
        protected ModuleDataSetupInterface $moduleDataSetup,
        protected ResourceConnection $resource
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
        $connection = $this->resource->getConnection();
        $data = [
            [
                'category_name'    => 'Lorem Category One',
                'category_url'  => 'lorem-category-one',
                'meta_title'    => 'Lorem Category One',
                'meta_content'  => 'Lorem Ipsum Category One',
                'parent_id'     => 0,
                'is_active'     => 1
            ],
            [
                'category_name'    => 'Lorem Category Two',
                'category_url'  => 'lorem-category-two',
                'meta_title'    => 'Lorem Category Two',
                'meta_content'  => 'Lorem Ipsum Category Two',
                'parent_id'     => 0,
                'is_active'     => 1
            ]
        ];
        $connection->insertMultiple(Category::MAIN_TABLE, $data);

        return $this;
    }
}
