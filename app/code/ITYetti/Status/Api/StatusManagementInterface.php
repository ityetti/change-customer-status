<?php

declare(strict_types=1);

namespace ITYetti\Status\Api;

use Magento\Framework\Controller\Result\Json;

/**
 * @api
 */
interface StatusManagementInterface
{
    /**
     * @param int $customerId
     * @param string $status
     * @return Json
     */
    public function change(int $customerId, string $status): Json;
}
