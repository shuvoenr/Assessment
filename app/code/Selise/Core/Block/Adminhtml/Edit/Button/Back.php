<?php

/**
 * This source file is subject to the selise.ch for short period of time
 *
 * @category  Core
 * @package   Selise_Core
 * @copyright Copyright (c) Selise (https://selise.ch) for short period of time
 * @author    Suvankar Paul <shuvoenr@gmail.com>
 *
 */

declare(strict_types=1);

namespace Selise\Core\Block\Adminhtml\Edit\Button;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back implements ButtonProviderInterface
{
    public function __construct(
        private readonly UrlInterface $urlBuilder
    ) {
    }

    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData(): array
    {
        $url = $this->urlBuilder->getUrl('*/*/');

        return [
            'label' => __('Back'),
            'class' => 'back',
            'on_click' => sprintf("location.href = '%s';", $url),
        ];
    }
}
