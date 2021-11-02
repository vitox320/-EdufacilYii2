<?php ?>


    <div class="row">
        <div class="col-md-8">
            <h2 class="text-left">Alunos</h2>
        </div>
        <div class="col-md-4">
            <i class="fas fa-plus-square adicionar fa-2x" data-toggle="modal" data-target="#ModalLongoExemplo"></i>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-5">
        <table class="table bg-white mr-5">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Matricula</th>
                <th>Média</th>
            </tr>
            </thead>

            <tbody>
            <?php if (sizeof($alunosVinculadosATurma) > 0) { ?>
                <?php foreach ($alunosVinculadosATurma as $alunoTurma) : ?>
                    <tr>
                        <td><?= $alunoTurma["alu_nome_alunos"]; ?></td>
                        <td><?= $alunoTurma["alu_id_alu"]; ?></td>
                        <td><?= $alunoTurma["not_valor_nota"]; ?></td>
                    </tr>

                <?php endforeach; ?>
            <?php } else { ?>
                <tr>
                    <td colspan="70%" class="text-center"> Não há alunos cadastrados nesta turma!</td>
                </tr>
            <?php } ?>

            </tbody>
        </table>

        <div class="info-turma">
            <h3>Turma:</h3>
            <h3><?= $id_turma ?> </h3>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="ModalLongoExemplo" tabindex="-1" role="dialog" aria-labelledby="TituloModalLongoExemplo"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class=" text-center">
                    <h4 class="modal-title" id="TituloModalLongoExemplo">Adicionar Alunos</h4>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <input type="hidden" name="id_turma" class="id_turma" value="<?= $id_turma ?>"/>
                        <?php if (sizeof($alunos) > 0) { ?>
                            <?php foreach ($alunos as $aluno) : ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span class="list-group-item-text"><?= $aluno["alu_nome_alunos"]; ?></span>
                                    <span class="list-group-item-text">
                                    <i class="fas fa-plus-square fa-2x vincular-aluno" id="<?= $aluno["alu_id_alu"] ?>"> </i>
                                </span>
                                </li>
                            <?php endforeach; ?>
                        <?php } ?>
                    </ul>
                </div>
                <div class="text-center pt-3 pb-3">
                    <button type="button" class="btn" style="background-color:#4F647F; color: white; font-weight: 400; "
                            data-dismiss="modal">Fechar
                    </button>

                </div>
            </div>
        </div>
    </div>

    <style>
        .info-turma {
            width: 400px;
            height: 300px;
            background-color: white;
            display: flex;
            justify-content: space-around;
        }

        .adicionar {
            cursor: pointer;

        }
        .vincular-aluno{
            cursor: pointer;
        }

    </style>

<?php
$this->registerJs($this->renderPhpFile(Yii::$app->basePath . '/assets/php-js/turma/_js-turma.php'), $this::POS_END);