<?php

namespace Smart\Customer\Block\Status;

use Magento\Framework\Escaper;
use Magento\Framework\View\Element\Template;

/**
 * Class Index
 * @package Smart\Customer\Block\Status
 */
class Index extends Template
{
    /**
     * @var Escaper
     */
    private $escaper;

    public function __construct(
        Template\Context $context,
        array $data = [],
        Escaper $escaper
    )
    {
        parent::__construct($context, $data);
        $this->escaper = $escaper;
    }

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

    /**
     * @return Escaper
     */
    public function getEscaper()
    {
        return $this->escaper;
    }
}
