<?php
/**
 * Shopgate GmbH
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file AFL_license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to interfaces@shopgate.com so we can send you a copy immediately.
 *
 * @author    Shopgate GmbH, Schloßstraße 10, 35510 Butzbach <interfaces@shopgate.com>
 * @copyright Shopgate GmbH
 * @license   http://opensource.org/licenses/AFL-3.0 Academic Free License ("AFL"), in the version 3.0
 */

class ShopgateItemsAbstract
{
    const PREFIX = 'BD';

    /** @var  ShopgatePluginPrestashop */
    protected $plugin;

    protected $module;

    /**
     * @param ShopgatePluginPrestashop
     */
    public function __construct($plugin)
    {
        $this->plugin = $plugin;
        $this->module = new ShopGate();
    }

    /**
     * @return ShopgatePluginPrestashop
     */
    public function getPlugin()
    {
        return $this->plugin;
    }

    /**
     * @return ShopGate
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @param float $price
     *
     * @return float
     */
    public function convertPrice($price)
    {
        if (Configuration::get('PS_CURRENCY_DEFAULT') != $this->plugin->getContext()->currency->id) {
            // Conversion rate of the default must not be 1.00 so we shouldn't convert the standard currency
            return (float) $this->plugin->getContext()->currency->conversion_rate * $price;
        }
        return (float) $price;
    }
}
