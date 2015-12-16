<?php
/**
 * Created by PhpStorm.
 * User: dex
 * Date: 12/11/15
 * Time: 9:17 PM
 */

class Bluewise_OrderSplit_Model_Type_Onepage extends Mage_Checkout_Model_Type_Onepage
{
    public function saveOrder() {
        $quote = $this->getQuote();

        $items = $quote->getAllItems();

        foreach($items as $k => $item) {

            $quote->removeAllItems()->save();

            $quote->addItem($item)->save();
            $item->isDeleted(false);


            foreach($quote->getAllAddresses() as $address) {

                $address->unsetData('cached_items_nonnominal');
                $address->unsetData('cached_items_nominal');
                $address->removeAllShippingRates();

            }

            $quote->setTotalsCollectedFlag(false);

            Mage::log($address->getShippingMethod(),null,'getShippingMethod.log',true);

            $address->setShippingAmount($address->getShippingRateByCode($address->getShippingMethod())->getPrice());
            $qty = $item->getQty(); // To order each of the same item if its qty > 1
            $item->setQty(1);
            $quote->collectTotals(); // Order Total should be matched to the price of each item
            if($qty > 1) {
                for($i = 1;$i < $qty;$i++) {
                    parent::saveOrder();
                }
            }

            parent::saveOrder();
            //break;
        }

        return $this;

    }
}