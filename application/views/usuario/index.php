<div class="content">
    <div class="titulo">
        <h3>Usuários</h3>
        <script src="<?php echo base_url('js/usuarios.js'); ?>"></script>
        <form action="<?= base_url() ?>usuarios/pesquisar" method="get" autocomplete="off">
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <a class="btn btn-success" data-toggle="modal" data-target=".modal-passagem"
                        id='cadastropassagem'>Adicionar</a>
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
            <table id="consultar_usuarios" class="table table-striped" style = "width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>E-mail</th>
                        <th>Data cadastro</th>
                        <th>Status</th>
                        <th style="text-align: center;">Ações</th>
                    </tr>
                </thead>
                <tr>
                    <?php foreach ($dados as $dado): ?>

                        <td>
                            <?= $dado['nome'] ?>
                        </td>
                        <td>
                            <?= $dado['login'] ?>
                        </td>
                        <td>
                            <?= $dado['email'] ?>
                        </td>
                        <td>
                            <?= $dado['datacadastro'] ?>
                        </td>
                        <td>
                            <?php if ($dado['status'] == 0): ?>
                                <span class="btn btn-danger btn-xs">Inativo</span>
                            <?php else: ?>
                                <span class="btn btn-success btn-xs">Ativo</span>
                            <?php endif; ?>
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