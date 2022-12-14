# Primeiro Helper Magento 1
Base de como é a estrutura de um módulo para funcionar com um helper no Magento 1, vamos criar um helper que vai apenas receber um texto e gerar um log com ele.

<h2>Mas o que é um helper?</h2>
Como o próprio nome já diz o helper é um ajudante, é aquela classe ou objeto no seu projeto que é para auxiliar as outras funções.

<h2>Ondem ficam os helpers?</h2>
Bem parecido com os controllers eles possuem uma pasta dedicada dentro da raiz do seu módulo, a pasta <strong>Helper</strong> e os arquivos podem ter qualquer nome, mas o nome padrão é <strong>Data.php</strong>

---
É necessário criar a estrutura básica de um módulo conforme explicado nesse tutorial <a href="https://github.com/ElNogara/Primeiro-Modulo-Magento-1">Primeiro Modulo Magento 1</a>, importante criar o config.xml, e o arquivo de ativação dentro de app/etc/module/NAMESPACE/MODULENAME. Mas uma observação importante é que o MODULENAME deve ser diferente e também se atentar ao apelido dado ao controller, pois ele deve ser único.

O helper deve ser declarado dentro do config.xml: segue abaixo um exemplo:
```
<?xml version="1.0"?>
<config>
    <modules>
        <Elnogara_FirstHelper>
            <version>1.0.0</version>
        </Elnogara_FirstHelper>
    </modules>
    <global> <!--Dentro do nó global-->
        <helpers> <!--Deve ser declarado dentro nó de helpers-->
            <elnogara_firsthelper> <!--Deve ser passado um apélido para o helper ser reconhecido pelo Magento-->
                <class>Elnogara_FirstHelper_Helper</class> <!--Deve ser apontado o caminho do helper, o Magento por padrão já busca pelo arquivo Data.php, mas caso o nome do seu Helper seja diferente, então será necessário passar depois de Namespace_Modulename_Helper_<Nome do seu arquivo>.-->
            </elnogara_firsthelper>
        </helpers>
    </global>
    <frontend>
        <routers>
            <nogaraajudante>
                <use>standard</use>
                <args>
                    <module>Elnogara_FirstHelper</module>
                    <frontName>firsthelper</frontName>
                </args>
            </nogaraajudante>
        </routers>
    </frontend>
</config>
```

É necessário criar o helper dentro de <strong>Helper/</strong>, e como explicado, segue abaixo exemplo:
```
<?php
class Elnogara_FirstHelper_Helper_Data extends Mage_Core_Helper_Abstract <!--Só é necessário passar o nome do helper dentro da classe-->
{
    public function gerarLog($texto) <!--Criamos uma função que será chamada futuramente-->
    {
        Mage::log($texto, Zend_Log::INFO, 'testeLog.log', true); <!--Função interna do Magento para criar logs-->
    }
}
```

Para chamar o Helper estarei criando um controller com o nome AjudanteController.php, abaixo o código:
```
<?php

class Elnogara_FirstHelper_AjudanteController extends Mage_Core_Controller_Front_Action
{
    public function logAction()
    {
        $helper = Mage::helper('elnogara_firsthelper'); //Para instanciar o helper é necessário chamar a função Mage::helper('') e dentro dela passar o apelido que você deu para o seu helper, assim o Magento vai identificar qual helper da plataforma você está chamando.
        
        $helper->gerarLog('Hello World -> Criando seu primeiro helper funcional.'); //Com o helper instânciado eu só preciso chamar qual função dentro dele estarei chamando, nesse caso é a 'gerarLog' e passo como parâmetro o texto que quero que seja gravado no log.
        echo "Log criado com sucesso.";
    }
}
```

Então seu módulo deve ficar com 3 arquivos criados:
etc/config.xml
controllers/AjudanteController.php
Helper/Data.php

Se estiverem configurados corretamente, basta acessar seu domínio de loja e passar o frontname/controller/action na sua url, no meu caso é:
'http://localhost/firsthelper/ajudante/log'

Me retorna a mensagem "Log criado com sucesso." que é a mensagem configurada dentro do Helper que está sendo chamado pelo Controller então funcionou tudo como gostariamos.
Agora nas pastas do Magento, acesse var/log e o arquivo testeLog.log terá sido criado.

<strong>Qualquer dúvida estou a disposição - <a href="https://wellingtonnogara.com/" style="color: red;">Wellington Nogara</a>.</strong>
