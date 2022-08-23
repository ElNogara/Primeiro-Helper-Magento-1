<?php

class Elnogara_FirstHelper_AjudanteController extends Mage_Core_Controller_Front_Action
{
    public function logAction()
    {
        $helper = Mage::helper('elnogara_firsthelper');
        $helper->gerarLog('Hello World -> Criando seu primeiro helper funcional.');
        echo "Log criado com sucesso.";
    }
}
