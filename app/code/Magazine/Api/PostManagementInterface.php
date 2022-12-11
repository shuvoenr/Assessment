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

namespace Selise\Magazine\Api;

interface PostManagementInterface
{
    /**
     * Retrieve list limiting by page
     *
     * @param int $page
     * @param int $limit
     * @return string
     */
    public function getList(int $page, int $limit): string;
}
