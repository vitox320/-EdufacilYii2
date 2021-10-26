<?php
$js = <<< JS

$(document).ready(function(){    
    $(".cadastrar-aluno").attr("disabled",true);
});


    let campoEmailAluno = false;
    let campoNomeAluno = false;
    let campoSenhaAluno = false;
    let campoConfirmaSenhaAluno = false;


$(".email_alunos,.nome_alunos,.senha_alunos,.confirma-senha").on("keyup",function (event){
   
    
    if($(event.target).hasClass("email_alunos")){
        
        const validaEmail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        const emailValidado =  validaEmail.test($(this).val())
        
        $(this).val() && emailValidado ? campoEmailAluno = true : campoEmailAluno = false;        
        
        if(campoEmailAluno === false){        
            $(".email-validator").removeClass("d-none");
        }else{
            $(".email-validator").addClass("d-none");
        }
    }
    
    if($(event.target).hasClass("nome_alunos")){
       $(this).val().length > 0 ? campoNomeAluno = true : campoNomeAluno = false;   
         
       if(campoNomeAluno === false){        
           $(".nome-validator").removeClass("d-none");
       }else{
           $(".nome-validator").addClass("d-none");
       }
    }
    
    if($(event.target).hasClass("senha_alunos")){
         $(this).val().length > 0 ? campoSenhaAluno = true : campoSenhaAluno = false; 
         if(campoSenhaAluno === false){        
            $(".senha-validator").removeClass("d-none");
         }else{
            $(".senha-validator").addClass("d-none");
         }
    }
    
    if($(event.target).hasClass("confirma-senha")){
        $(this).val().length > 0 ? campoConfirmaSenhaAluno = true : campoConfirmaSenhaAluno = false;  
        if(campoConfirmaSenhaAluno === false){        
            $(".confirma-senha-validator").removeClass("d-none");
        }else{
            $(".confirma-senha-validator").addClass("d-none");
        }
    }
    //console.log(campoEmailAluno,campoNomeAluno,campoSenhaAluno,campoConfirmaSenhaAluno)
   
    if(campoEmailAluno && campoNomeAluno && campoSenhaAluno && campoConfirmaSenhaAluno ){
        $(".cadastrar-aluno").prop("disabled",false);
    }else {
        $(".cadastrar-aluno").prop("disabled",true);
    }
        
});

JS;
echo $js;