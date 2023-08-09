<?php
namespace Custom\Module\Plugin\Catalog\Model ;
class ProductView
{
    public function afterGetDescription(\Magento\Catalog\Block\Product\View $subject, $result)
    {
        $storeManager = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Store\Model\StoreManagerInterface');
        $sid = $storeManager->getStore()->getStoreId();
        $wid = $storeManager->getStore()->getWebsiteId();
        if ($sid == 2 ||$sid == 4 || $sid == 7 ) {
            if($subject->hasData('product_description_english'))
            {  
                //$description = $subject->getData('description');
                //$description = $subject->getDescription();
                $description = $subject->getAttributeText('product_description_english');  
                echo $description;            
                return $description;             
            }
        }elseif ($sid == 3 ||$sid == 5 || $sid == 6) {
            if($subject->hasData('product_description_france')) {
                //$description = $subject->getData('description');
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
}

?>

