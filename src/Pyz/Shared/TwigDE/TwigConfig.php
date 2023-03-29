<?php

namespace Pyz\Shared\TwigDE;

use Spryker\Shared\Twig\TwigConfig as SprykerTwigConfig;

class TwigConfig extends SprykerTwigConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getYvesThemeName(): string
    {
        return "newTheme";
    }

    // /**
    //  * @api
    //  *
    //  * @return string
    //  */
    // public function getYvesThemeNameDefault(): string
    // {
    //     return "newTheme";
    // }


}
