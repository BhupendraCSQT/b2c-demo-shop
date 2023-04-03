<?php

namespace Pyz\Zed\ContentFooGui\Communication\Plugin\ContentGui;

use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\ContentGuiExtension\Dependency\Plugin\ContentPluginInterface;
use pyz\Zed\ContentFooGui\Communication\Form\ContentFooTermForm;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class ContentFooFormPlugin extends AbstractPlugin implements ContentPluginInterface
{
    /**
     * @return string
     */
    public function getTermKey(): string
    {
        return 'Foo';
    }

    /**
     * @return string
     */
    public function getTypeKey(): string
    {
        return 'Foo';
    }

    /**
     * @return string
     */
    public function getForm(): string
    {
        return ContentFooTermForm::class;
    }

    /**
     * @param array|null $params
     *
     * @return \Generated\Shared\Transfer\ContentFooTermTransfer
     */
    public function getTransferObject(?array $params = null): TransferInterface
    {
        $contentFooTermTransfer = new ContentFooTermTransfer();

        if ($params) {
            $contentFooTermTransfer->fromArray($params);
        }

        return $contentFooTermTransfer;
    }
}