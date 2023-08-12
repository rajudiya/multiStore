<?php
    namespace Spacename\Modulename\Model\ResourceModel;
    class Test extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb  {

    //     protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    //     {
    //   // do your logic here

    //     }

       protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
        {  
          $description = $object->getData('description');
          $description = $object->setData('product_description_english');
          return $description;

        }



    }