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

namespace Selise\Core\Block\System\Config\Fieldset\Hint;

use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\View\Element\Template;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;

class Documentation extends Template implements RendererInterface
{
    /**
     * @var string
     */
    protected $_template = 'Selise_Core::system/config/fieldset/hint/documentation.phtml';

    /**
     * Render fieldset html
     *
     * @param   AbstractElement $element
     * @return  string
     */
    public function render(AbstractElement $element): string
    {
        return $this->toHtml();
    }
}
