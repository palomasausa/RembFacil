
   <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"and !empty($_POST)) //$form _enviado vai ser iggual a true se chegamos na pagina por POST  e se houver algum dado  na variavel global $_POST se isto não for verdade ai vai ser false o form_enviado.
      $form_enviado=true;//
      else
      	$form_enviado=false;

    	$falhou=false ;//a variável $falhou controla se a validação do formulário foi feita ou não  
     function valida_cnpj_de_usuario($cnpj_de_usuario){
    if(strlen($cnpj_de_usuario) < 14)
    	return"<p>Seu cnpj de usuario é muito curto.Insira pelo menos 14 caracteres</p>";// Nós queremos saber o que a minha função retornou para o usuario
     else if (strlen($cnpj_de_usuario) >=15)
     	return"<p>Seu cnpj de usuario é muito comprido.Insira no máximo 15 caracteres</p>";	
}
    function valida_nome_de_usuario($nome_de_usuario){
    if(strlen($nome_de_usuario)< 8)
    	return"<p>Seu nome de usuario é muito curto.Insira pelo menos 8 caracteres</p>";
     else if (strlen($nome_de_usuario) > 25)
     	return"<p>Seu nome de usuario é muito comprido.Insira no máximo  25 caracteres</p>";
}
    function valida_telefone_de_usuario($telefone_de_usuario){
    if(strlen($telefone_de_usuario)< 9)
    	return"<p>Seu telefone de usuario é muito curto.Insira pelo menos 9 caracteres</p>";
     else if (strlen($telefone_de_usuario) > 12)
     	return"<p>Seu telefone de usuario é muito comprido.Insira no máximo 12 caracteres</p>";
}
     	
function valida_email_de_usuario($email_de_usuario){
    if(strlen($email_de_usuario)< 9)
    	return"<p>Seu email de usuario é muito curto.Insira pelo menos 9 caracteres</p>";
     else if (strlen($email_de_usuario) > 37)
     	   return"<p>Seu email  de usuario é muito comprido.Insira no máximo 37 caracteres</p>";

     }
     	function valida_senha_de_usuario($senha_de_usuario){
    if(strlen($senha_de_usuario)< 8)
    	return"<p>Sua senha de usuario é muita curta.Insira pelo menos 8 caracteres</p>";
     else if (strlen($senha_de_usuario) > 10)
     	   return"<p>Sua senha de usuario é muito comprida.Insira no máximo 10 caracteres</p>";
}
function valida_titulo($titulo){
    if(strlen($titulo)< 5)
        return"<p>O titulo digitado é muita curto.Insira pelo menos 5 caracteres</p>";
     else if (strlen($titulo) >50)
           return"<p>O titulo digitado é muito comprido.Insira no máximo 50 caracteres</p>";

}

function valida_descricao($descricao){
    if(strlen($descricao)< 50)
        return"<p>A descrição digitada é muita curta.Insira pelo menos 50 caracteres</p>";
     else if (strlen($descricao) >150)
           return"<p>A descrição digitada é muito comprida.Insira no máximo 150 caracteres</p>";

}

function valida_cpf_de_funcionario($cpf){
 if(strlen($cpf)< 11)
        return"<p>o cpf digitado é muito curto.Insira pelo menos 11 caracteres</p>";
             else if (strlen($cpf) >14)
               return"<p>O cpf digitado é muito comprido.Insira no máximo 14 caracteres</p>";

}
// function validaSenha(senha){}


// vallidações da nota fiscal,descrição,datae valor do gasto á ser devolvido
function valida_nota_fiscal($nf){
    if ($nf["size"] > 10 * 1024 * 1024) // 10MB
        return "<p>O arquivo enviado possui mais de 10mb escolha um com até 10 mb!!</p>";
}
   
function valida_valor_compra($valor_compra){
if(strlen($valor_compra)< 1)
return"<p>o valor digitado é muito curto.Insira pelo menos 1 caractere.</p>";
else if (strlen($valor_compra) > 6)
return"<p>O  valor digitado é muito comprido.Insira no máximo 6 caracteres.</p>";
}
      
function valida_descricao_compra($descricao_compra){
    if(strlen($descricao_compra) < 5)
    return"<p>A descrição digitada é muito curta.Insira pelo menos 5 caracteres.</p>";
    else if (strlen($descricao_compra) > 50)
    return"<p>A descrição digitada é muito comprida.Insira no máximo 50 caracteres.</p>";
}

function valida_nome_estabelecimento($nome_estabelecimento){
    if(strlen($nome_estabelecimento) < 5)
    return"<p>o nome do estabelecimento  digitado é muito curto.Insira pelo menos 5 caracteres.</p>";
    else if (strlen($nome_estabelecimento) > 15)
    return"<p>O  nome do estabelecimento digitado é muito comprido.Insira no máximo 15 caracteres.</p>";
}

function valida_justificativa($justificativa){
    if (strlen($justificativa) < 20)
        return "<p>Sua justificativa é muito curta. Insira pelo menos 20 caracteres.</p>";
    else if (strlen($justificativa) > 100)
        return "<p>Sua justificativa é muito longa. Insira no máximo 100 caracteres.</p>";
}

function valida_senha_de_funcionario($senha){
    if (strlen($senha) < 8)
        return "<p>Sua senha é muito curta. Insira pelo menos 8 caracteres.</p>";
    else if (strlen($senha) > 15)
        return "<p>Sua senha é muito longa. Insira no máximo 15 caracteres.</p>";
}

         
?>