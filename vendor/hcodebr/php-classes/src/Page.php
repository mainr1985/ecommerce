<?php
//classe Page

//essa página tem header e footer template para as demais páginas - RainTPL

namespace Hcode; 
use Rain\Tpl; //namespace do raintpl 

class Page
{
    private $tpl;

    //criando variáveis default para passar pro template
    private $defaults = [
        "data" => [], //é um array vazio por padrão
    ];

    private $options = [];

    //as variáveis pra usar com o tpl vao vir de acordo com as rotas definidas no slim
    public function __construct($opts = array(), $tpl_dir = "/views/")
    {
        //fazendo um merge entre as opçoes passadas pelas rotas e o array data=[]
        $this->options = array_merge( $this->defaults, $opts ); //função array_merge mescla 2 arrays. o ÚLTIMO array sobrescreve o 1o. O valor informado pra aqui deve sobrescrever o default.

        //vai usar o rainTPL aqui!
        $config = array (
                    "base_url"      => null,/*tirar se for usar o vhost*/
                    "tpl_dir" => $_SERVER["DOCUMENT_ROOT"] . "/ecommerce/" . $tpl_dir, //assim o php vai procurar nas pastas no root do projeto
                    "cache_dir" => $_SERVER["DOCUMENT_ROOT"] . "/ecommerce/views-cache/",
                    "debug" => false //true deixa mais lerdo
        );
       
        Tpl::configure ($config);
        $this->setData($this->options["data"]); //passando os dados recebidos pro array $options
        $this->tpl = new Tpl; //transformando em atributo pra que possa ser acessado de outros métodos

        //desenhando o template - toda vez que for instanciada a classe Page, vai vir pra cá pra desenhar o template na tela.
        $this->tpl->draw("header"); 
    }

    //método para verificar os dados recebidos e designar valores
    private function setData($data = array())
    {
        foreach ($data as $key=>$value)
        {
            $this->tpl->assign($key,$value); //acessando o método pré-estabelecido 'assign' do tpl
        }
    }

    /*
    aqui será criado o corpo do html das páginas que se repetirão (conteúdo). 
    Recebendo por parâmetros: nome do template, quais os dados que se quer passar (variaveis) e se deseja que retorne direto pra tela o resultado ou armazene
    */
    public function setTpl($name, $data = array(), $returnHTML = false)
     {
        $this->setData($data);
     
        return $this->tpl->draw($name,$returnHTML); //desenhando o template - toda vez que for instanciada a classe Page, vai vir pra cá pra desenhar o template na tela.
    }

    //método mágico destrutor, último a ser executado
    public function __destruct()
    {
        //aqui será adicionado o footer do template - só quando a página sair da memória do php
        $this->tpl->draw("footer"); 
    }
}
?>