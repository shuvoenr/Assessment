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

namespace Selise\Magazine\Plugin;

use Magento\Cms\Model\PageFactory;
use Magento\Framework\Data\Tree\NodeFactory;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;

class Topmenu
{
    public function __construct(
        protected readonly NodeFactory $nodeFactory,
        protected readonly PageFactory $pageFactory,
        protected readonly StoreManagerInterface $storeManager,
        protected readonly UrlInterface $urlBuilder
    ) {
    }

    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $outermostClass = '',
        $childrenWrapClass = '',
        $limit = 0
    ) {
        //-- Add Custom Menu
        $node = $this->nodeFactory->create(
            [
                'data' => [
                    'name'       => __('Magazine'),
                    'id'         => 'magazine-menu',
                    'url'        => $this->urlBuilder->getUrl(null, ['_direct' => 'magazine']),
                    'has_active' => false,
                    'is_active'  => false
                ],
                'idField' => 'id',
                'tree' => $subject->getMenu()->getTree()
            ]
        );
        $subject->getMenu()->addChild($node);
    }
}
