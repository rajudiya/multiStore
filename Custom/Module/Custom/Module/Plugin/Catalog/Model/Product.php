<?php
namespace Custom\Module\Plugin\Catalog\Model ;
class Product
{
    public function afterGetProductCollection(\Magento\Catalog\Model\Layer $subject, $result) {
        //$result->addAttributeToSort('brand','ASC'); //DESC for descending.
        $result->addAttributeToSort('product_name_english');
        $result->setName('Rohan'); //For dropdown type attribute you can use this.
        return $result;
    }
}

?>