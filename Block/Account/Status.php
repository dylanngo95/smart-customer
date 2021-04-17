<?php

namespace Smart\Customer\Block\Account;

use Magento\Framework\View\Element\Template;

/**
 * Class Status
 * @package Smart\Customer\Block\Account
 */
class Status extends Template
{
    /**
     * Render block HTML
     *
     * @return string
     */
    protected function _toHtml()
    {
        if (false != $this->getTemplate()) {
            return parent::_toHtml();
        }
    }
}
