<div class="content">
    <div class="titulo">
        <h2>Colaborador</h2>
        <script src="<?php echo base_url('js/colaborador.js'); ?>"></script>
        <form action="<?= base_url() ?>colaborador/pesquisar" method="get" autocomplete="off">
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <a href="<?= base_url() ?>colaborador/cadastro" class="btn btn-primary">Adicionar</a>
                    <input type="text" class="form-pesquisa" name="Pesquisa" id="Pesquisa" placeholder="Filtrar Pelo Nome:">
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

        <div class="panel panel-inverse" id="filtro" style=" display: none;">
            <form action="<?= base_url() ?>colaborador/pesquisar" method="get" autocomplete="off">

                <div class="form-group col-sm-12" style="margin-top: 10px;">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Data Inicial:</label>
                            <input type="date" class="form-control" name="DataInicial" id="DataInicial"
                                style="height: 30px;" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Data Final:</label>
                            <input type="date" class="form-control" name="DataFinal" id="DataFinal"
                                style="height: 30px;" />
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="nome" id="nome" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Documento:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="documento"
                                id="documento" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Telefone:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="telefone"
                                id="telefone" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Cep:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="cep" id="cep" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Bairro:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="bairro" id="bairro" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Rua:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="rua" id="rua" />
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Numero:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="numero" id="numero" />
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="Ativo">Ativo:</label>
                            <select class="form-control selects" style="height: 30px;" name="Ativo" id="Ativo">

                                <option value="">Selecione</option>
                                <option value="0">Ativo
                                </option>
                                <option value="1">Inativo
                                </option>
                            </select>
                        </div>
                    </div>



                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="TipoColaborador">Tipo Colaborador:</label>
                            <select class="form-control selects" style="height: 30px;" name="tipo_colaborador"
                                id="tipo_colaborador">

                                <option value="">Selecione</option>
                                <option value="0">Funcionário
                                </option>
                                <option value="1">Fornecedor
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary ">
                    <i class="fa fa-search"></i> Pesquisar
                </button>
        </div>
        </form>

    </div>

    <div class='corpo'>
        <div class="tabela-responsive">
            <table id="consultar_usuarios" class="table table-striped">
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
                        <th>Ativo</th>
                        <th style="text-align: center;">Ações</th>
                    </tr>
                </thead>
                <tr>

                    <?php foreach ($colaborador as $dado): ?>

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
                        <td>
                            <?= $dado['datacadastro'] ?>
                        </td>
                        <td>
                            <?= $dado['ativo'] == 0 ? 'Inativo' : 'Ativo' ?>
                        </td>
                        <td style="text-align: center"><a id="remover"
                                href="<?= base_url() ?>colaborador/delete/<?= $dado['id'] ?>" class="btn btn-danger"><i
                                    class="fa fa-trash"></i></a>
                            <a href="<?= base_url() ?>colaborador/editar/<?= $dado['id'] ?>" class="btn btn-info"><i
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