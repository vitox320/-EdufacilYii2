<?php

$js = <<< JS

    
    
    $(".adicionar").on("click",function(event){
        event.preventDefault();
        
        const divContainer = document.createElement("div");
        divContainer.classList.add("container");
        divContainer.classList.add("bg-white");
        divContainer.classList.add("shadow");
        divContainer.classList.add("lista-perguntas");
        divContainer.classList.add("mt-5");
        
        const divRow = document.createElement("div");
        divRow.classList.add("row");
        
        const divCol = document.createElement("div");
        divCol.classList.add("col-md-12");        
        
        const inputEnunciado = document.createElement("input");
        inputEnunciado.setAttribute("type","text");
        inputEnunciado.setAttribute("name","TesteQuestoes[tqu_enunciado][]");
        inputEnunciado.setAttribute("placeholder","Enunciado");
        inputEnunciado.classList.add("form-control");       
        
        
        divCol.appendChild(inputEnunciado);
        divRow.appendChild(divCol);
        divContainer.appendChild(divRow);
        
        for(let i = 1; i <= 5; i++){
            
            const divRowAlternativa = document.createElement("div");
            divRowAlternativa.classList.add("row");
                        
            const divColAlternativa = document.createElement("div");
            divColAlternativa.classList.add("col-md-4");           
            
            const inputAlternativa = document.createElement("input");
            inputAlternativa.setAttribute("type","text");
            inputAlternativa.setAttribute("name","TesteQuestoes[tqu_alternativa][]");
            inputAlternativa.setAttribute("placeholder","Alternativa "+ i );  
            inputAlternativa.classList.add("form-control");
            
            divColAlternativa.appendChild(inputAlternativa);
            
            divRowAlternativa.appendChild(divColAlternativa);
            divContainer.appendChild(divRowAlternativa);
        }
        
        const divEventosBotoes = document.createElement("div");
        divEventosBotoes.classList.add("d-flex");
        divEventosBotoes.classList.add("flex-column");
        divEventosBotoes.classList.add("ml-3");
        
        const divSpanBotaoExcluir = document.createElement("span");
        divSpanBotaoExcluir.classList.add("cursors")
        
        const divIconeExcluir = document.createElement("i");
        divIconeExcluir.classList.add("fas");
        divIconeExcluir.classList.add("fa-trash");
        divIconeExcluir.classList.add("fa-2x");
        divIconeExcluir.classList.add("excluir-pergunta");
        divIconeExcluir.setAttribute("title","Excluir Enunciado");
        
        divSpanBotaoExcluir.appendChild(divIconeExcluir);
        divEventosBotoes.appendChild(divSpanBotaoExcluir);
        
        divContainer.append(divEventosBotoes);
        
        $(".conteudo-principal").append(divContainer);
        
        
                       
    });

    $(".excluir-pergunta").on("click",function (event){
            
           console.log(event)
        
    });

JS;
echo $js;
