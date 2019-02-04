<?php
/**
 * Apptha
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.apptha.com/LICENSE.txt
 *
 * ==============================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * ==============================================================
 * This package designed for Magento COMMUNITY edition
 * Apptha does not guarantee correct work of this extension
 * on any other Magento edition except Magento COMMUNITY edition.
 * Apptha does not provide extension support in case of
 * incorrect edition usage.
 * ==============================================================
 *
 * @category    Apptha
 * @package     Apptha_Onestepcheckout
 * @version     0.1.9
 * @author      Apptha Team <developers@contus.in>
 * @copyright   Copyright (c) 2014 Apptha. (http://www.apptha.com)
 * @license     http://www.apptha.com/LICENSE.txt
 *
 * */
class Apptha_Onestepcheckout_Helper_Data extends Mage_Core_Helper_Abstract {
//get the Onestepcheckout activated settings and return the boolean

    public function isOnepageCheckoutLinksEnabled()
    {
        return Mage::getStoreConfig('onestepcheckout/general/Activate_apptha_onestepcheckout');
    }

    public function domainKey($tkey) {

        $message = "EM-SCMP0EFIL9XEV8YZAL7KCIUQ6NI5OREH4TSEB3TSRIF2SI1ROTAIDALG-JW";
        $lenkey = strlen($tkey);
        for ($i = 0; $i < $lenkey; $i++) {
            $key_array[] = $tkey[$i];
        }
        $enc_message = "";
        $kPos = 0;
        $chars_str = "WJ-GLADIATOR1IS2FIRST3BEST4HERO5IN6QUICK7LAZY8VEX9LIFEMP0";
        $lenCharStr = strlen($chars_str);
        for ($i = 0; $i < $lenCharStr; $i++) {
            $chars_array[] = $chars_str[$i];
        }
        $messagelen = strlen($message);
        $countKeyArray = count($key_array);
        for ($i = 0; $i < $messagelen; $i++) {
            $char = substr($message, $i, 1);

            $offset = $this->getOffset($key_array[$kPos], $char);
            $enc_message .= $chars_array[$offset];
            $kPos++;
            if ($kPos >= $countKeyArray) {
                $kPos = 0;
            }
        }

        return $enc_message;
    }
    public function license()
    {
     return 'license';
    }
    public function getOffset($start, $end) {

        $chars_str = "WJ-GLADIATOR1IS2FIRST3BEST4HERO5IN6QUICK7LAZY8VEX9LIFEMP0";
        $charlenstr = strlen($chars_str);
        for ($i = 0; $i < $charlenstr; $i++) {
            $chars_array[] = $chars_str[$i];
        }
        $countCharsArr = count($chars_array);
        for ($i = $countCharsArr - 1; $i >= 0; $i--) {
            $lookupObj[ord($chars_array[$i])] = $i;
        }

        $sNum = $lookupObj[ord($start)];
        $eNum = $lookupObj[ord($end)];

        $offset = $eNum - $sNum;

        if ($offset < 0) {
            $offset = count($chars_array) + ($offset);
        }

        return $offset;
    }
    /**
     * Get Modules installed status
     * if module installed means return 1 otherwise 0
     *
     */
    public function getModuleInstalledStatus($moduleName) {
                $modules = Mage::getConfig()->getNode('modules')->children();
                $modulesArray = (array) $modules;
                if (isset($modulesArray[$moduleName])) {
                        if ($moduleName == 'Apptha_Deliveryschedule') {
                                return Mage::getStoreConfig ( 'deliveryschedule/general/delivery_schedule_enabled' );
                            }
                }
                else {
                      return 0;
                }
    }

}