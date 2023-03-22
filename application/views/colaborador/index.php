<div class="content">
    <div class="titulo">
        <h2>Colaborador</h2>
    
        <form name="" method="post" autocomplete="off">
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <a href="<?= base_url() ?>colaborador/cadastro" class="btn btn-primary">Adicionar</a>
                    <input type="text" class="form-pesquisa" name="Pesquisa" id="Pesquisa" placeholder="Pesquisar...">
                    <button class="btn btn-primary" type="submit" id="button-addon1">
                        <i class="fa fa-search"></i> Pesquisar
                    </button>
                    <button class="btn btn-info" type="button" id="div-filtro"
                        onclick="return($('#filtro').toggle('fade'))">
                        <i class="fa fa-filter"></i> Mais Filtros
                    </button>
                </div>
            </div>

        </form>

        <div class="panel panel-inverse" id="filtro" style="display: none;">
            <div class="panel-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <input type="text" class="form-control" name="PesquisaVendasId"
                                        id="PesquisaVendasId" />

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Data Inicio</label>
                                    <input type="date" class="form-control" name="DataInicial" id="DataInicial"
                                        required />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Data Final</label>
                                    <input type="date" class="form-control" name="DataFinal" id="DataFinal" required />
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </form>

    </div>

    <div class='corpo'>
        <div class="tabela-responsive">
        <table class="table table-bordered table-houver">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>Telefone</th>
                    <th>Cep</th>
                    <th>Bairro</th>
                    <th>Rua</th>
                    <th>Numero</th>
                    <th>Tipo Colaborador</th>
                    <th>Data Cadastro</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tr>
                <?php foreach ($dados as $dado): ?>

                    <td>
                        <?= $dado['nome'] ?>
                    </td>
                    <td>
                        <?= $dado['documento'] ?>
                    </td>
                    <td>
                        <?= $dado['telefone'] ?>
                    </td>
                    <td>
                        <?= $dado['cep'] ?>
                    </td>
                    <td>
                        <?= $dado['bairro'] ?>
                    </td>
                    <td>
                        <?= $dado['rua'] ?>
                    </td>
                    <td>
                        <?= $dado['numero'] ?>
                    </td>
                    <td>
                        <?= $dado['tipo_colaborador'] == 0 ? 'Funcionário' : 'Fornecedor' ?>
                    </td>
                    <td><?= $dado['datacadastro'] ?></td>
                    <td style="text-align: center"><a id="remover"
                                href="#" class="btn btn-danger"><i
                                    class="fa fa-trash"></i></a>
                            <a href="# ?>" class="btn btn-info"><i
                                    class="fa fa-pencil"></i></a>
                        </td>
                </tr>
                <tbody>
                </tbody>
            <?php endforeach ?>
        </table>
    </div>
</div>

</div>