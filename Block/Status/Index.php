<?php

namespace Smart\Customer\Block\Status;

use Magento\Framework\View\Element\Template;

/**
 * Class Index
 * @package Smart\Customer\Block\Status
 */
class Index extends Template
{
    private $customerStatus = [
        'default' => 'Default',
        'active' => 'Active',
        'inactive' => 'Inactive'
    ];

    /**
     * @return array
     */
    public function getCustomerStatus(): array
    {
        return $this->customerStatus;
    }

    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->_urlBuilder->getUrl(
            'smart_customer/status/save',
            ['_secure' => true]
        );
    }
}
