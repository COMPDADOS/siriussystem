<?php

class dadosBuscaCliente
{
    private $IMB_CLT_ID;
    private $IMB_CLT_CPF;
    private $IMB_CLT_NOME;

    public function SetCodigo( $codigo )
    {
        $this->IMB_CLT_ID = $codigo; 
    }
    
    public function GetCodigo()
    {
        return $this->IMB_CLT_ID;
    }
    
    public function GetCpf()
    {
        return $this->IMB_CLT_CPF;
    }
    public function SetCpf( $cpf )
    {
        $this->IMB_CLT_CPF = $cpf; 
    }

    public function GetNome()
    {
        return $this->IMB_CLT_NOME;
    }

    public function SetNome( $nome )
    {
        $this->IMB_CLT_NOME = $nome; 
    }

}


?>