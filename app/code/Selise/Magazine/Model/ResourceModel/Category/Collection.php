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

namespace Selise\Magazine\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Selise\Magazine\Model\Category;
use Selise\Magazine\Model\ResourceModel\Category as ResourceCategory;

class Collection extends AbstractCollection
{
    /**
     * Index Constructor
     * */
    protected function _construct()
    {
        $this->_init(Category::class, ResourceCategory::class);
    }
}
