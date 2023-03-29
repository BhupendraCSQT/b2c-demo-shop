<?php
namespace Pyz\Yves\Cart\Controller;

use Generated\Shared\Transfer\ItemTransfer;
use Pyz\Yves\Cart\Plugin\Provider\CartControllerProvider;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Spryker\Client\Cart\CartClientInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @method CartClientInterface getClient()
 */
class CartController extends AbstractController
{

    /**
     * @param string $sku
     * @param int $quantity
     * @param array $optionValueUsageIds
     *
     * @return RedirectResponse
     */
    public function addAction($sku, $quantity, $optionValueUsageIds = [])
    {
        // Get the client
        $cartClient = $this->getClient();

        // Build a transfer object
        $itemTransfer = new ItemTransfer();
        $itemTransfer->setId($sku);
        $itemTransfer->setQuantity($quantity);

        // Add the item:
        //  Behind this, there is a request to Zed.
        //  The response is stored in the session.
        $cartClient->addItem($itemTransfer);

        return $this->redirectResponseInternal(CartControllerProvider::ROUTE_CART);
    }
}