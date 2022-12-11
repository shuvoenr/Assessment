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

namespace Selise\Magazine\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
    /**
     * Index Constructor
     *
     * @return void
     * */
    protected function _construct(): void
    {
        $this->_init(ResourceModel\Post::class);
    }
}
