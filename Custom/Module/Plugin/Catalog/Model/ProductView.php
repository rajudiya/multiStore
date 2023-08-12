<?php
namespace Custom\Module\Plugin\Catalog\Model ;
class ProductView
{
    public function aroundCheckQuoteItemQty(
        \Magento\CatalogInventory\Api\StockStateInterface $subject,
        callable $proceed,
        $productId,
        $qty,
        $operator = null,
        $websiteId = null
    ) {
        // $storeManager = \Magento\Framework\App\ObjectManager::getInstance()->get('\Magento\Store\Model\StoreManagerInterface');
        // $sid = $storeManager->getStore()->getStoreId();
        // $wid = $storeManager->getStore()->getWebsiteId();
         $product = $productId;
        // if ($wid == 2) {    
        //     if (!$productId instanceof Product) {
        //         $product = $this->productRepository->getById($productId);
        //     }    
        //     $customStockQty = $product->getData('qty');//getCustomStockQuantity();QuantityWeb1
        //     if ($customStockQty !== null) {
        //         $qty = $customStockQty;
        //     }
                
        //         return $proceed($product, $qty, $operator, $websiteId);
        //     }
        
        // if ($wid == 3) {    
        //     if (!$productId instanceof Product) {
        //         $product = $this->productRepository->getById($productId);
        //     }    
        //     $customStockQty = $product->getData('quantity_web_2');//getCustomStockQuantity();
        //     if ($customStockQty !== null) {
        //         $qty = $customStockQty;
        //     }
                
        //         return $proceed($product, $qty, $operator, $websiteId);
        //     } 

        // if ($wid == 4) {    
        //     if (!$productId instanceof Product) {
        //         $product = $this->productRepository->getById($productId);
        //     }    
        //     $customStockQty = $product->getData('quantity_web_4');//getCustomStockQuantity();
        //     if ($customStockQty !== null) {
        //         $qty = $customStockQty;
        //     }
                
        //         return $proceed($product, $qty, $operator, $websiteId);
        //     } 



        if (!$productId instanceof Product) {
            $product = $this->productRepository->getById($productId);
        }
        
        $customStockQty = 50;//$product->getCustomStockQuantity();
        if ($customStockQty !== null) {
            $qty = $customStockQty;
        }
        
        return $proceed($product, $qty, $operator, $websiteId);
    }
}

?>
