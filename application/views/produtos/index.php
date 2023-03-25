<div class="content">
    <div class="titulo">
        <h2>Produtos</h2>
        <script src="<?php echo base_url('js/produtos.js'); ?>"></script>
        <form name="" method="post" autocomplete="off">
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <a href="<?= base_url() ?>produtos/cadastro" class="btn btn-success">Adicionar</a>
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
            <form action="<?= base_url() ?>produtos/pesquisar" method="get" autocomplete="off">
                <div class="form-group col-sm-12" style="margin-top: 10px;">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="nome" id="nome" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Preço:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="preco" id="preco" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Quantidade:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="quantidade" id="quantidade" />
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
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Descrição:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="descricao" id="descricao" />
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
            <table id="consultar_usuarios" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                      <th>Nome</th>
                         <th>Descrição</th>
                         <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Status</th>
                        <th style="text-align: center">Ação</th>
                    </tr>
                </thead>
                <tr>
                    <?php foreach ($produtos as $produto): ?>

                         <td>
                            <?= $produto['nome'] ?>
                        </td>
                       <td>
                            <?= $produto['descricao'] ?>
                        </td>
                       <td>
                            <?= reais($produto['preco']) ?>
                        </td>
                         <td>
                            <?= $produto['quantidade'] ?>
                        </td>
                        <td>
                            <?php if ($produto['status'] == 0): ?>
                                <span class="btn btn-danger btn-xs">Inativo</span>
                            <?php else: ?>
                                <span class="btn btn-success btn-xs">Ativo</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center"><a id="remover"
                                href="<?= base_url('produtos/delete/' . $produto['id']) ?>" class="btn btn-danger btn-xs"><i
                                    class="fa fa-trash"></i></a>
                            <a href="<?= base_url() ?>produtos/editar/<?= $produto['id'] ?>" class="btn btn-info btn-xs"><i
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