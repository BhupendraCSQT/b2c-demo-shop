<?php

namespace Pyz\Zed\ProductCategory\Business\Internal\DemoData;

use ProjectA\Zed\Console\Business\Model\Console;
use ProjectA\Zed\Library\Business\DemoDataInstallInterface;

/**
 * Class ProductCategoryMappingInstall
 * @package Pyz\Zed\ProductCategory\Business\Internal\DemoData
 */
class ProductCategoryMappingInstall implements DemoDataInstallInterface
{

    /**
     * @var array
     */
    protected $demoProductCategories = [
        [
            'product-sku' => '11',
            'category-name' => 'Schuhe, Stiefel und Socken',
        ],
        [
            'product-sku' => '21',
            'category-name' => 'Schuhe, Stiefel und Socken',
        ],
        [
            'product-sku' => '31',
            'category-name' => 'Jacken, Westen und Parka',
        ],
        [
            'product-sku' => '41',
            'category-name' => 'Atemschutz',
        ],
        [
            'product-sku' => '51',
            'category-name' => 'Kopfschutz',
        ],
    ];

    /**
     * @param Console $console
     */
    public function install(Console $console)
    {
        $locale = \ProjectA_Shared_Library_Store::getInstance()->getCurrentLocale();
        $categoryNodeIds = $this->installProductCategories($locale);
        $this->touchProductCategories($categoryNodeIds);
    }

    /**
     * @param $locale
     * @return array
     * @throws \Exception
     * @throws \PropelException
     */
    protected function installProductCategories($locale)
    {
        $categoryNodeIds = [];
        foreach ($this->demoProductCategories as $demoProductCategory) {
            $productId = $this->getProductId($demoProductCategory['product-sku']);
            $categoryNodeId = $this->getCategoryNodeId($demoProductCategory['category-name'], $locale);

            if ($productId && $categoryNodeId) {
                $productCategory = new \ProjectA_Zed_ProductCategory_Persistence_Propel_PacProductCategory();
                $productCategory->setFkProduct($productId);
                $productCategory->setFkCategoryNode($categoryNodeId);
                $productCategory->save();

                $categoryNodeIds[] = $productCategory->getFkCategoryNode();
            }
        }

        return $categoryNodeIds;
    }

    /**
     * @param array $categoryNodeIds
     * @throws \Exception
     * @throws \PropelException
     */
    protected function touchProductCategories(array $categoryNodeIds)
    {
        /** @var \ProjectA_Zed_ProductCategory_Persistence_Propel_PacProductCategory $productCategory */
        foreach ($categoryNodeIds as $categoryNodeId) {
            $touchedProduct = \ProjectA_Zed_YvesExport_Persistence_Propel_PacYvesExportTouchQuery::create()
                ->filterByItemId($categoryNodeId)
                ->filterByExportType(\ProjectA_Zed_YvesExport_Persistence_Propel_PacYvesExportTouchPeer::EXPORT_TYPE_SEARCH)
                ->filterByItemEvent(\ProjectA_Zed_YvesExport_Persistence_Propel_PacYvesExportTouchPeer::ITEM_EVENT_ACTIVE)
                ->filterByItemType('product-category')
                ->findOne();

            if (!$touchedProduct) {
                $touchedProduct = new \ProjectA_Zed_YvesExport_Persistence_Propel_PacYvesExportTouch();
            }

            $touchedProduct->setItemType('product-category');
            $touchedProduct->setItemEvent(\ProjectA_Zed_YvesExport_Persistence_Propel_PacYvesExportTouchPeer::ITEM_EVENT_ACTIVE);
            $touchedProduct->setExportType(\ProjectA_Zed_YvesExport_Persistence_Propel_PacYvesExportTouchPeer::EXPORT_TYPE_SEARCH);
            $touchedProduct->setTouched(new \DateTime());
            $touchedProduct->setItemId($categoryNodeId);
            $touchedProduct->save();
        }
    }

    /**
     * @param $productSku
     * @return int|null
     */
    protected function getProductId($productSku)
    {
        $productEntity = \ProjectA_Zed_Product_Persistence_Propel_PacProductQuery::create()
            ->findOneBySku($productSku);
        if ($productEntity) {
            return $productEntity->getProductId();
        }

        return null;
    }

    /**
     * @param $categoryName
     * @param $locale
     * @return int|null
     */
    protected function getCategoryNodeId($categoryName, $locale)
    {
        $categoryNodeEntity = \ProjectA_Zed_CategoryTree_Persistence_Propel_PacCategoryNodeQuery::create()
            ->useCategoryQuery()
                ->useAttributeQuery()
                    ->filterByLocale($locale)
                    ->filterByName($categoryName)
                ->endUse()
            ->endUse()
            ->findOne();
        if ($categoryNodeEntity instanceof \ProjectA_Zed_CategoryTree_Persistence_Propel_PacCategoryNode) {
            return $categoryNodeEntity->getIdCategoryNode();
        }

        return null;
    }
}