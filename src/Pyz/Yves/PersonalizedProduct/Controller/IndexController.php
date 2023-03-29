<?php

namespace Pyz\Yves\PersonalizedProduct\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use \Spryker\Yves\Kernel\View\View;

class IndexController extends AbstractController
{
    /**
     * @param int $limit
     *
    //  * @return View
     *   @return \Spryker\Yves\Kernel\View\View
     */
    public function indexAction(int $limit): View
    {
        $searchResults = $this->getClient()->getPersonalizedProducts($limit);

        return $this->view(
            $searchResults,
            [],
            '@PersonalizedProduct/views/index/index.twig'
        );
        //    return $this->view( [], [], '@PersonalizedProduct/views/index/index.twig' );
    }
}
