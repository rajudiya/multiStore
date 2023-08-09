<?php
namespace Custom\Module\Plugin\Catalog\Model ;
class Product
{
    /**
     * All Name Attribute Created By Manually
     */
    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        $storeManager = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Store\Model\StoreManagerInterface');
        $sid = $storeManager->getStore()->getStoreId();
        $wid = $storeManager->getStore()->getWebsiteId();
        if ($sid == 2 ||$sid == 4 || $sid == 7 ) {
            if($subject->hasData('product_name_english'))
            {                
            //return $subject->getData('product_name_english');
            return $subject->getAttributeText('description');             
            }
            // if($subject->hasData('product_description_english'))
            // {  
            //     $description = $subject->getData('description');
            //     //$description = $subject->getDescription();
            //     $description = $subject->getData('product_description_english');              
            //     return $description;             
            // }
        }elseif ($sid == 3 ||$sid == 5 || $sid == 6) {
            if($subject->hasData('product_name_france')) {
                return $subject->getData('product_name_france');
            }
            // if($subject->hasData('product_description_france')) {
            //     $description = $subject->getData('description');
            //     //$description = $subject->getDescription();
            //     $description = $subject->getData('product_description_france');              
            //     return $description;
            // }
        }else {
            return $subject->getData('name');
            //return $subject->getData('description');
        }
    }

    /**
     * All Price Attribute Created By Manually
     */
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
        }elseif ($wid == 3) {
            if($subject->hasData('price_web_2')) {
                $price = $subject->getData('price');
                $price = $subject->getData('price_web_2');
                return  $price;
            }
        }elseif ($wid == 4) {
            if($subject->hasData('price_web_3')) {
                $price = $subject->getData('price');
                $price = $subject->getData('price_web_3');
                return  $price;
            }
        }
        else {
            return $subject->getData('price');
        }




        if ($wid == 2) {
            if($subject->hasData('quantity_and_stock_status') >= 1)
            {                
                $quantity = $subject->getData('quantity_and_stock_status');
                $quantity = $subject->getData('quantity_web_1');
                return  $quantity;           
            }
        }elseif ($wid == 3) {
            if($subject->hasData('quantity_and_stock_status')) {
                $quantity = $subject->getData('quantity_and_stock_status');
                $quantity = $subject->getData('quantity_web_2');
                return  $quantity;
            }
        }elseif ($wid == 4) {
            if($subject->hasData('quantity_and_stock_status')) {
                $quantity = $subject->getData('quantity_and_stock_status');
                $quantity = $subject->getData('quantity_web_3');
                return  $quantity;
            }
        }
        else {
            return $subject->getData('quantity_and_stock_status');
        }


    }

    public function afterGetDescription(\Magento\Catalog\Model\Product $subject, $result)
    {
        $storeManager = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Store\Model\StoreManagerInterface');
        $sid = $storeManager->getStore()->getStoreId();
        $wid = $storeManager->getStore()->getWebsiteId();
        if ($sid == 2 ||$sid == 4 || $sid == 7 ) {
            if($subject->hasData('product_description_english'))
            {  
                $description = $subject->getData('description');
                //$description = $subject->getDescription();
                $description = $subject->getData('product_description_english');  
                echo $description;            
                return $description;             
            }
        }elseif ($sid == 3 ||$sid == 5 || $sid == 6) {
            if($subject->hasData('product_description_france')) {
                $description = $subject->getData('description');
                //$description = $subject->getDescription();
                $description = $subject->getData('product_description_france');
                echo $description;       
                return $description;
            }
        }else {
            //return $subject->getDescription();
            return "Hello New".$subject->getData('description');
        }
    }
    // public function afterGetProductDescription(\Magento\Catalog\Block\Product\View $subject, $result)
    // {
    //     // Modify the product description here
    //     $modifiedDescription = "Modified Description: " . $result;
        
    //     return $modifiedDescription;
    // }
}

?>

