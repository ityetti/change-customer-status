<?php

declare(strict_types=1);

namespace ITYetti\Status\Service;

use ITYetti\Status\Api\StatusManagementInterface;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\ResourceModel\CustomerRepository as ResourceCustomerRepository;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Exception;

class StatusManagement implements StatusManagementInterface
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var ResourceCustomerRepository
     */
    private $resourceCustomer;

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * @param CustomerRepositoryInterface $customerRepository
     * @param ResourceCustomerRepository $resourceCustomer
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        ResourceCustomerRepository $resourceCustomer,
        JsonFactory $jsonFactory
    ) {
        $this->customerRepository = $customerRepository;
        $this->resourceCustomer = $resourceCustomer;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @param int $customerId
     * @param string $status
     * @return Json
     */
    public function change(int $customerId, string $status): Json
    {
        $response = array();
        try {
            $customer = $this->customerRepository->getById($customerId);
            $customer->setCustomAttribute('change_status', $status);
            $this->resourceCustomer->save($customer);
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
        }
        $response['status'] = 'success';
        $response['message'] = 'You successful update status';
        $resultJson = $this->jsonFactory->create();

        return $resultJson->setData($response);
    }
}
