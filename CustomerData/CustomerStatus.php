<?php

namespace Smart\Customer\CustomerData;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\CustomerData\SectionSourceInterface;
use Magento\Customer\Model\Session;
use Smart\Customer\Api\CustomerStatusInterface;

/**
 * Class CustomerStatus
 * @package Smart\Customer\CustomerData
 */
class CustomerStatus implements SectionSourceInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var Session
     */
    private $session;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        Session $session
    ) {
        $this->customerRepository = $customerRepository;
        $this->session = $session;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getSectionData()
    {
        $customerStatus = 'Not define';
        $customerId = $this->session->getCustomerId();
        if ($customerId) {
            $customer = $this->customerRepository->getById($customerId);
            $customerStatus = $customer->getCustomAttribute(CustomerStatusInterface::SMART_CUSTOMER_STATUS)->getValue() ?? '';
        }
        return [
            'st' => $customerStatus
        ];
    }
}
