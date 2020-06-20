function testaCPF(strCPF) { /* testando cpf e telefone  para  saber se o número digitados é aceitável pelo sistema*/
    var Soma;
    var Resto;
    Soma = 0;
  if (strCPF == "00000000000") return false;
     
  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);/* inicio da verificação para obter um cpf valido */
  Resto = (Soma * 10) % 11;
   
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
   
  Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
   
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;/*Fim da Logica para obter um cpf valido */
  Resto = (Soma * 10) % 11;
}

function testaTelefone(telefone) { /*logica para testar telefone*/
    return telefone.length < 16 && telefone.length > 9;
}

function valida() {  /*a função valida  o cpf e telefone */
    var form = document.forms["form-cadastro"];

    //ler  estaValido=testaCPF
// modificar 
    return testaCPF(form["cpf"].value) &&
    testaTelefone(form["telefone"].value);

}

function toggleNav(){
  $("nav").first().toggleClass("expanded");
}

//coloca a imagem dentro do overlay e mostra o overlay
function definirImagemEmOverlay(event){
  
  const overlay = $("#overlay");
  const img = event.target;
  
  // console.log("batata");
  // a intenção que se clicando em uma imagem na pagina de reembolos e esta imagem ira aprecer em overlay
  
    overlay.append(`<img src='${img.src}' />`);
  overlay.css("visibility", "visible");
   
}
// retira a imagem do overlay e esconde o overlay
$("#overlay").on("click", function(){
  $(this).html("");
  $(this).css("visibility", "hidden");
});

//quando se clica nestas imagens era será aberta vale somente para a imagem dentro do article
$("#pagina-listareembolso article img").on("click", definirImagemEmOverlay);
$("#pagina-consultareembolso article img").on("click", definirImagemEmOverlay);