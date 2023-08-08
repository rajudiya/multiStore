<?php

namespace Custom\Module\Model;

use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Framework\Exception\LocalizedException;

class ProductAttributeDataUpdater
{
    protected $productAttributeRepository;

    public function __construct(ProductAttributeRepositoryInterface $productAttributeRepository)
    {
        $this->productAttributeRepository = $productAttributeRepository;
    }

    /**
     * Update product attribute data store-wise
     *
     * @param string $attributeCode
     * @param array $storeValues
     * @throws LocalizedException
     */
    public function updateStoreValues(string $attributeCode, array $storeValues)
    {
        // Load the product attribute
        $attribute = $this->productAttributeRepository->get($attributeCode);

        // Update the store-wise attribute values
        foreach ($storeValues as $storeId => $value) {
            $attribute->setStoreId($storeId);
            $attribute->setFrontendLabel($value); // Change this line if you want to update other attributes

            $this->productAttributeRepository->save($attribute);
        }
    }
}
