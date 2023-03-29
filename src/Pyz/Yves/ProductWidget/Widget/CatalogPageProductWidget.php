<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Pyz\Yves\ProductWidget\Widget;

use SprykerShop\Yves\ProductWidget\Widget\CatalogPageProductWidget as SprykerCatalogPageProductWidget;
use Spryker\Yves\Kernel\Widget\AbstractWidget;

/**
 * @method \SprykerShop\Yves\ProductWidget\ProductWidgetFactory getFactory()
 */
class CatalogPageProductWidget extends SprykerCatalogPageProductWidget
{
    /**
     * @param mixed[] $product
     * @param string|null $viewMode
     */
    public function __construct(array $product, $viewMode = null , $loopStatus)
    {
        $this->addParameter('product', $product)
            ->addParameter('viewMode', $viewMode)
            ->addParameter('loopStatus', $loopStatus);
            // loopStatus parameter set for indexing

        /** @deprecated Use global widgets instead. */
        $this->addWidgets($this->getFactory()->getCatalogPageSubWidgets());
    }

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'CatalogPageProductWidget';
    }

    /**
     * @return string
     */
    public static function getTemplate(): string
    {
        return '@ProductWidget/views/catalog-product/catalog-product.twig';
    }
}
