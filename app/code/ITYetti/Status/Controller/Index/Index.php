<?php

declare(strict_types=1);

namespace ITYetti\Status\Controller\Index;

use Magento\Customer\Model\Session;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;

class Index implements ActionInterface
{
    /**
     * @var ResultFactory
     */
    private $resultFactory;

    /**
     * @var Session
     */
    private $session;

    /**
     * @param ResultFactory $resultFactory
     * @param Session $session
     */
    public function __construct(
        ResultFactory $resultFactory,
        Session $session
    ) {
        $this->resultFactory = $resultFactory;
        $this->session = $session;
    }

    /**
     * @return ResponseInterface|Redirect|ResultInterface|Page
     */
    public function execute()
    {
        if (!$this->session->isLoggedIn()) {
            $redirection = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $redirection->setPath('customer/account/login');
            return $redirection;
        }

        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}
