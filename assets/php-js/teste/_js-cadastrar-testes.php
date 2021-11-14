<?php

$js = <<< JS

    
    $(document).on("click",".adicionar,.excluirDiv",function(event){
       if($(event.target).hasClass("adicionar")){
             event.preventDefault();
        
            const divContainerFlex = document.createElement("div");
            divContainerFlex.classList.add("d-flex");
            divContainerFlex.classList.add("justify-content-center");
            divContainerFlex.classList.add("conteudo-perguntas");
            divContainerFlex.classList.add("mt-5");
            
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
            inputEnunciado.classList.add("mt-4");     
            
            
            
            divCol.appendChild(inputEnunciado);
            divRow.appendChild(divCol);
            divContainer.appendChild(divRow);
            
            for(let i = 1; i <= 5; i++){
                
                const divRowAlternativa = document.createElement("div");
                divRowAlternativa.classList.add("row");
                            
                const divColAlternativa = document.createElement("div");
                divColAlternativa.classList.add("col-md-4");           
                
                const divColFormGroup = document.createElement("div");
                divColFormGroup.classList.add("form-group");
                
                const inputAlternativa = document.createElement("input");
                inputAlternativa.setAttribute("type","text");
                inputAlternativa.setAttribute("name","TesteQuestoes[tqu_alternativa][]");
                inputAlternativa.setAttribute("placeholder","Alternativa "+ i );  
                inputAlternativa.classList.add("form-control");
                inputAlternativa.classList.add("mt-4");
                
                
                const divInputGabarito = document.createElement("div");
                divInputGabarito.classList.add("col-md-4");
                divInputGabarito.classList.add("mt-5");
                
                const spanVerdadeiraLabel = document.createElement("span");
                spanVerdadeiraLabel.innerHTML = "Resposta Verdadeira: ";
                
                const inputRespostaVerdadeira = document.createElement("input");
                inputRespostaVerdadeira.setAttribute("name","gabarito[]");
                inputRespostaVerdadeira.setAttribute("type","checkbox");
                inputRespostaVerdadeira.setAttribute("value","1");
                inputRespostaVerdadeira.classList.add("cl_gabarito");
                
                const spanFalsaLabel = document.createElement("span");
                spanFalsaLabel.innerHTML = "Resposta Falsa : "
                
                const inputRespostaFalsa = document.createElement("input");
                inputRespostaFalsa.setAttribute("name","gabarito[]");
                inputRespostaFalsa.setAttribute("type","checkbox");
                inputRespostaFalsa.setAttribute("value","0");
                inputRespostaFalsa.setAttribute("checked","true");
                inputRespostaFalsa.classList.add("cl_gabarito");
                
                
                divInputGabarito.appendChild(spanVerdadeiraLabel);
                divInputGabarito.appendChild(inputRespostaVerdadeira);
                divInputGabarito.appendChild(spanFalsaLabel);
                divInputGabarito.appendChild(inputRespostaFalsa);
                
                divRowAlternativa.appendChild(divColAlternativa);
                divRowAlternativa.appendChild(divInputGabarito);
                divColAlternativa.appendChild(divColFormGroup);
                divColFormGroup.appendChild(inputAlternativa);            
                divContainer.appendChild(divRowAlternativa);
            }
            
            const divEventosBotoes = document.createElement("div");
            divEventosBotoes.classList.add("d-flex");
            divEventosBotoes.classList.add("flex-column");
            divEventosBotoes.classList.add("ml-3");
            divEventosBotoes.classList.add("mt-5");
            
            
            const divSpanBotaoExcluir = document.createElement("span");
            divSpanBotaoExcluir.classList.add("cursors")
            
            
            const divIconeExcluir = document.createElement("i");
            divIconeExcluir.classList.add("fas");
            divIconeExcluir.classList.add("fa-trash");
            divIconeExcluir.classList.add("fa-2x");        
            divIconeExcluir.classList.add("excluirDiv");            
            divIconeExcluir.setAttribute("title","Excluir Enunciado");
            divSpanBotaoExcluir.appendChild(divIconeExcluir);
            divEventosBotoes.appendChild(divSpanBotaoExcluir);        
            
            divContainerFlex.append(divContainer);
            divContainerFlex.append(divEventosBotoes);
            
            $(".conteudo-principal").append(divContainerFlex);              
       } 
       
       if($(event.target).hasClass("excluirDiv")){
           event.stopPropagation();        
           $(this).parent().parent().parent().remove();
       }
    });
    


  

JS;
echo $js;
