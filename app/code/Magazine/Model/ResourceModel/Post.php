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

namespace Selise\Magazine\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    public const MAIN_TABLE    = 'selise_magazine_post';
    public const ID_FIELD_NAME = 'post_id';

    /**
     * Index Constructor
     *
     * @return void
     * */
    protected function _construct(): void
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
