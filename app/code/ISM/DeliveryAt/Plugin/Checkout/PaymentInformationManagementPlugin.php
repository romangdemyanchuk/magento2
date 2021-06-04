<?php
namespace ISM\DeliveryAt\Plugin\Checkout;


/**
 * One page checkout processing model
 */
class PaymentInformationManagementPlugin
{

    protected $orderRepository;

    public function __construct(
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
    }


    public function aroundSavePaymentInformationAndPlaceOrder(
        \Magento\Checkout\Model\PaymentInformationManagement $subject,
        \Closure $proceed,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    ) {
        $result = $proceed($cartId, $paymentMethod, $billingAddress);

        if($result){

            $orderComment =$paymentMethod->getExtensionAttributes();
            if ($orderComment->getComment())
                $comment = trim($orderComment->getComment());
            else
                $comment = '';


            $history = $order->addStatusHistoryComment($comment);
            $history->save();
            $order->setCustomerNote($comment);
        }

        return $result;
    }
}
