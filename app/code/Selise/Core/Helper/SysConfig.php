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

namespace Selise\Core\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

/**
 * System Configuration Getter
 *
 * Get Store System Configuration Data
 *
 */
class SysConfig extends AbstractHelper
{
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Store's System Configuration Data Getter
     *
     * @param string $path <p>
     * Full Config Path Store Configuration Values.
     * Specifically from core_config_data table
     * </p>
     * @return mixed
     */
    public function getConfig(string $path): mixed
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }
}
