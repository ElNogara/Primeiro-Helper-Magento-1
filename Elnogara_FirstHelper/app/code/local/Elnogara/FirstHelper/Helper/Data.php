<?php
class Elnogara_FirstHelper_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function gerarLog($texto)
    {
        Mage::log($texto, Zend_Log::INFO, 'testeLog.log', true);
    }
}
