<?php
$csrfToken = Yii::$app->request->getCsrfToken();
$urlAdicionaAlunoTurma = Yii::$app->urlManager->createUrl(["turma/vincula-aluno-turma"]);
$js = <<< JS

$(document).ready(function(){    
   
});

$(".vincular-aluno").on("click",function(event){
    const id_turma = $(".id_turma").val();
    const id_aluno = $(this).attr("id");
    
    
          var dadosForm = [];
              dadosForm.push(
                  {'name': '_csrf','value': '$csrfToken'},
                  {'name': 'id_turma', 'value': id_turma},
                  {'name': 'id_aluno', 'value': id_aluno},
              );
              
              $.post('$urlAdicionaAlunoTurma', dadosForm, function(resultado) {}, 'json')
               .done(function(resultado) {
                   
               })
               .always(function(resultado) {
               null;
               });
});

JS;
echo $js;