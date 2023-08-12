<?php
namespace Custom\Module\Plugin\Catalog\Model;

use Magento\InventoryApi\Api\SourceItemsSaveInterface;
use Magento\InventoryApi\Api\Data\SourceItemInterfaceFactory;
use Magento\Framework\ObjectManagerInterface;
use Magento\Inventory\Model\SourceItem\Command\GetSourceItemsBySku;

class Product
{


    /** @var SourceItemsSaveInterface */
protected $sourceItemsSaveInterface;

/** @var SourceItemInterfaceFactory */
protected $sourceItemInterfaceFactory;

/** @var GetSourceItemsBySku */
protected $getSourceItemsBySku;

/** @var ObjectManagerInterface */
protected $objectManager;

/**
 *
 * @param SourceItemsSaveInterface      $sourceItemsSaveInterface
 * @param SourceItemInterfaceFactory    $sourceItemInterfaceFactory
 * @param ObjectManagerInterface        $objectManager
 * @param GetSourceItemsBySku           $getSourceItemsBySku
 //* @param SourceItemInterface           $sourceItemInterface
 */
public function __construct(
    SourceItemsSaveInterface $sourceItemsSaveInterface,
    SourceItemInterfaceFactory $sourceItemInterfaceFactory,
    ObjectManagerInterface $objectManager,
    GetSourceItemsBySku $getSourceItemsBySku,
) {
    $this->sourceItemsSaveInterface = $sourceItemsSaveInterface;
    $this->sourceItemInterfaceFactory = $sourceItemInterfaceFactory;
    $this->objectManager = $objectManager;
    $this->getSourceItemsBySku = $getSourceItemsBySku;
}



/**
 * Updates product quantityn and stock status
 *
 * @param string $sku
 * @param int    $qty
 *
 * @return void
 * @throws \Magento\Framework\Exception\CouldNotSaveException
 * @throws \Magento\Framework\Exception\InputException
 * @throws \Magento\Framework\Validation\ValidationException
 * @throws \Throwable
 */
public function updateProduct(string $sku, int $qty): void
{
        $sourceItems = $this->getSourceItemsBySku->execute($sku);

        foreach ($sourceItems as $item){
            $qty = $item->getData('quantity_web_2');
            //if ($item->getSourceCode() === 'default'){

                $sourceItem = $this->sourceItemInterfaceFactory->create();
                //$sourceItem->setSourceCode('default');
                $sourceItem->setSku($sku);
                $sourceItem->setQuantity($qty);
                $sourceItem->setStatus((bool)$qty);
                $this->sourceItemsSaveInterface->execute([$sourceItem]);
                $product = $this->objectManager->get('Magento\Catalog\Model\Product');
                $stockRegistry = $this->objectManager->create('Magento\CatalogInventory\Api\StockRegistryInterface');

                if($product->getIdBySku($sku)) {
                    $stockItem = $stockRegistry->getStockItem($product->getId());
                    $stockItem->setQty($qty);
                    $stockItem->setIsInStock((bool)$qty);
                    $stockRegistry->updateStockItemBySku($sku, $stockItem);
                }

                break;
           // }
        }
}


    /**
     * All Name Attribute Created By Manually
     * Overrride the GetName function
     * @return String
     */
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

    /**
     * All Price Attribute Created By Manually
     * overrride the GetPrice function
     * @return Integer
     */
    public function afterGetPrice(\Magento\Catalog\Model\Product $subject, $result)
    {
        $storeManager = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Store\Model\StoreManagerInterface');
        $sid = $storeManager->getStore()->getStoreId();
        $wid = $storeManager->getStore()->getWebsiteId();
        if ($wid == 2) { // Check Website Id
            if($subject->hasData('price_web_1') >= 1) // Checking Condition to Custom Product Price is 1 or Greater than 1 its condition is True Then Execute the Code
            {                
                $price = $subject->getData('price'); // get Actual Product Price
                $price = $subject->getData('price_web_1'); // Replace Custom product price
                return  $price; // return Replesed Price 
            }
        }elseif ($wid == 3) {
            if($subject->hasData('price_web_2') >= 1) {
                $price = $subject->getData('price');
                $price = $subject->getData('price_web_2');
                return  $price;
            }
        }elseif ($wid == 4) {
            if($subject->hasData('price_web_3') >= 1) {
                $price = $subject->getData('price');
                $price = $subject->getData('price_web_3');
                return  $price;
            }
        }else {
            return $subject->getData('price');
        }
    }

    /**
     * All Special price Attribute Created By Manually
     * override the Special price Function
     * @return Integer
     */
    public function afterGetSpecialPrice(\Magento\Catalog\Model\Product $subject, $result) {
        $storeManager = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Store\Model\StoreManagerInterface');
        $sid = $storeManager->getStore()->getStoreId();
        $wid = $storeManager->getStore()->getWebsiteId();
        if ($wid == 2) {    
            if ($subject->hasData('special_price_web_1') >=1) { // Checking Condition to Custom Product Special Price is 1 or Greater than 1 its condition is True Then Execute the Code
                $specialprice = $subject->getData('special_price');
                $specialprice = $subject->getData('special_price_web_1');
                $subject->setQuantity('quantity_web_1');
                return  $specialprice;
            }      
        }elseif ($wid == 3) {
            if ($subject->hasData('special_price_web_2') >=1) {
                $specialprice = $subject->getData('special_price');
                $specialprice = $subject->getData('special_price_web_2');
                $subject->setQuantity('quantity_web_2');
                return  $specialprice;
            } 
        }elseif ($wid == 4) {
            if ($subject->hasData('special_price_web_3') >=1) {
                $specialprice = $subject->getData('special_price');
                $specialprice = $subject->getData('special_price_web_3');
                $subject->setQuantity('quantity_web_3');
                return  $specialprice;
            } 
        }
        else {
            return $subject->getData('special_price');
        }
    }
    
}

?>
