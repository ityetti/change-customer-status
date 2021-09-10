<?php

declare(strict_types=1);

namespace ITYetti\Status\Plugin;

use Magento\Customer\CustomerData\Customer;
use Magento\Customer\Helper\Session\CurrentCustomer;

class StatusAttributes
{
    /**
     * @var CurrentCustomer
     */
    private $currentCustomer;

    /**
     * @param CurrentCustomer $currentCustomer
     */
    public function __construct(
        CurrentCustomer $currentCustomer
    ) {
        $this->currentCustomer = $currentCustomer;
    }

    /**
     * @param Customer $subject
     * @param $result
     * @return mixed
     */
    public function afterGetSectionData(Customer $subject, $result)
    {
        $customer = $this->currentCustomer->getCustomer();
        $result['changeStatus'] = $customer->getCustomAttribute('change_status')->getValue();

        return $result;
    }
}
