<?php
namespace Custom\Module\Plugin\Catalog\Model ;
class Product
{
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $storeManager = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Store\Model\StoreManagerInterface');
        $sid = $storeManager->getStore()->getStoreId();
        $wid = $storeManager->getStore()->getWebsiteId();
        if ($sid == 2 ||$sid == 4 || $sid == 7 ) {
            if($subject->hasData('product_name_english'))
            {                
            return $subject->getData('product_name_english');             
            }
        }elseif ($sid == 3 ||$sid == 5 || $sid == 6) {
            if($subject->hasData('product_name_france')) {
                return $subject->getData('product_name_france');
            }
        }else {
            return $subject->getData('name');
        }
    }

    //price
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $storeManager = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Store\Model\StoreManagerInterface');
        $sid = $storeManager->getStore()->getStoreId();
        $wid = $storeManager->getStore()->getWebsiteId();
        if ($wid == 2) {
            if($subject->hasData('price_web_1') >= 1)
            {                
                $price = $subject->getData('price');
                $price = $subject->getData('price_web_1');
                return  $price;           
            }
        }elseif ($wid == 2) {
            if($subject->hasData('price_web_2')) {
                $price = $subject->getData('price');
                $price = $subject->getData('price_web_2');
                return  $price;
            }
        }elseif ($wid == 3) {
            if($subject->hasData('price_web_3')) {
                $price = $subject->getData('price');
                $price = $subject->getData('price_web_3');
                return  $price;
            }
        }
        else {
            return $subject->getData('price');
        }
    }
}

?>
