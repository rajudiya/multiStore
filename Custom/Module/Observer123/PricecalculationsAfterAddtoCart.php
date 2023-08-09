<?php
namespace Custom\Module\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
 
class PricecalculationsAfterAddtoCart implements ObserverInterface
{
     
public function execute(\Magento\Framework\Event\Observer $observer) 
{
            $writer = new \Zend\Log\Writer\Stream(BP.'/var/log/stackexchange.log');
            $logger = new \Zend\Log\Logger();
            $logger->addWriter($writer);
            /* Code here */
            $quote_item = $observer->getEvent()->getQuoteItem();
            $price = 400; //set your price here
            $quote_item->setCustomPrice($price);
            $quote_item->setOriginalCustomPrice($price);
            $quote_item->getProduct()->setIsSuperMode(true);

            $logger->info("success !!!!");
            
    }
}