<?php
namespace ISM\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Index
 * @package ISM\Blog\Controller\Blog
 */
class Index extends Action
{
    public function execute()
    {
        $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $page;
    }
}
