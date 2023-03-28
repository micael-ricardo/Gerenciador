<div class="content">
    <div class="titulo">
        <h3>Usuários</h3>
        <script src="<?php echo base_url('js/usuarios.js'); ?>"></script>
       <!-- No ajax não estava reconhecendo o caminho tive que fazer esse ajuste tecnico    -->
       <script>
            var excluirUrl = "<?php echo base_url('excluir'); ?>";
        </script>

        <form action="<?= base_url() ?>usuarios/pesquisar" method="get" autocomplete="off">
            <div class="input-group mb-3">
                <div class="input-group-append">
                <a href="<?= base_url() ?>Usuarios/cadastro" class="btn btn-success">Adicionar</a>
                    <input type="text" class="form-pesquisa" name="Pesquisa" id="Pesquisa"
                        placeholder="Filtrar Pelo Nome:">
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
            <form action="<?= base_url() ?>usuarios/pesquisar" method="get" autocomplete="off">
                <div class="form-group col-sm-12" style="margin-top: 10px;">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="nome" id="nome" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Login:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="login" id="login" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="email" id="email" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="Status">Status:</label>
                            <select class="form-control selects" style="height: 30px;" name="status" id="status">
                                <option value="">Selecione</option>
                                <option value="1">Ativo
                                </option>
                                <option value="0">Inativo
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
<!-- Modal de exluir    -->
    <div id="modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h5>Certeza que deseja inativar: <span id="nome-usuario"></span>?</h5>
        <form id="confirmar-exclusao" method="POST" action="<?= base_url() ?>Usuarios/delete">
            <input type="hidden" name="id">
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Confirmar</button>
            <a href="<?= base_url() ?>Usuarios" type="button" class="btn btn-primary"><i class="fa fa-times"></i> Cancelar</a>
        </form>
    </div>
</div>

        <div class="tabela-responsive">
            <table id="consultar_usuarios" class="table table-striped" style="width:100%">
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
                            <?= formatar_data($dado['datacadastro']) ?>
                        </td>
                        <td>
                            <?php if ($dado['status'] == 0): ?>
                                <span class="btn btn-danger btn-xs">Inativo</span>
                            <?php else: ?>
                                <span class="btn btn-success btn-xs">Ativo</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center">
                            <a id="abrir-modal" href="#" class="btn btn-danger btn-xs excluir-usuario" data-nome="<?= $dado['nome'] ?>"
                                data-id="<?= $dado['id'] ?>"><i class="fa fa-trash"></i></a>

                            <a href="<?= base_url() ?>usuarios/editar/<?= $dado['id'] ?>" class="btn btn-info btn-xs"><i
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
