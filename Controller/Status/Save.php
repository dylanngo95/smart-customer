<?php

namespace Smart\Customer\Controller\Status;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Smart\Customer\Api\CustomerStatusInterface;
use Magento\Framework\Controller\Result\JsonFactory;


/**
 * Class Save
 * @package Smart\Customer\Controller\Status
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var Session
     */
    private $session;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param Session $session
     */
    public function __construct(
        Context $context,
        CustomerRepositoryInterface $customerRepository,
        Session $session
    ) {
        $this->customerRepository = $customerRepository;
        $this->session = $session;
        parent::__construct($context);

    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        try {
            $params = $this->getRequest()->getParams();
            $customerId = $this->session->getCustomerId();
            if ($customerId && $params['status']) {
                /** @var \Magento\Customer\Api\Data\CustomerInterface $customer */
                $customer = $this->customerRepository->getById($customerId);
                $customer->setCustomAttribute(CustomerStatusInterface::SMART_CUSTOMER_STATUS, $params['status']);
                $this->customerRepository->save($customer);
                return $resultJson->setData([
                    'status' => true
                ]);
            }
            return $resultJson->setData([
                'status' => false
            ]);
        } catch (\Exception $e) {
            return $resultJson->setData([
                'status' => false
            ]);
        }
    }
}
