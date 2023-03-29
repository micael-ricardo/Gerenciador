<div class="content">
    <div class="titulo">
        <h3>Pedidos</h3>
        <script src="<?php echo base_url('js/pedidos.js'); ?>"></script>
        <form action="<?= base_url() ?>Pedidos/pesquisar" method="get" autocomplete="off">
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <a href="<?= base_url() ?>Pedidos/cadastro" class="btn btn-success">Adicionar</a>
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

        <div class="panel panel-inverse" id="filtro" style=" display: none;">
            <form action="<?= base_url() ?>Pedidos/pesquisar" method="get" autocomplete="off">
                <div class="form-group col-sm-12" style="margin-top: 10px;">

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
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="TipoPessoa">Tipo Pessoa:</label>
                            <select class="form-control selects" style="height: 30px;" name="tipo_pessoa"
                                id="tipo_pessoa">
                                <option value="">Selecione</option>
                                <option value="0">Fisica
                                </option>
                                <option value="1">Jurídica
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
            <table id="consultar_usuarios" class="table table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Valor Total</th>
                        <th>Forma de Pagamento</th>
                        <th>Fornecedor</th>
                        <th>Data Cadastro</th>
                        <th>Cep</th>
                        <th>Estado</th>
                        <th>Cidade</th>
                        <th>Bairro</th>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Observação</th>
                        <th>Data Retirada</th>   
                        <th>Status</th>
                        <th style="text-align: center;">Ações</th>
                    </tr>
                </thead>
                <tr>
                    <?php foreach ($pedidos as $dado): ?>
                        <td>
                            <?= $dado['pedido_nome'] ?>
                        </td>
                        <td>
                            <?= formatar_telefone($dado['pedido_telefone']) ?>
                        </td>
                        <td>
                            <?= $dado['produto_nome'] ?>
                        </td>
                        <td>
                            <?= reais($dado['produto_preco']) ?>
                        </td>
                        <td>
                            <?= $dado['pedido_quantidade'] ?>
                        </td>
                        <td>
                            <?= reais($dado['pedido_valor_total']) ?>
                        </td>
                        <td>

                        <?php if ($dado['pedido_forma_pagamento'] == 'dinheiro'): ?>
                                <span class="btn btn-success btn-xs">Dinheiro</span>
                            <?php else: ?>
                                <span class="btn btn-primary btn-xs">Cartão</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= $dado['fornecedor_nome'] ?>
                        </td>
                        <td>
                            <?=  formatar_data($dado['pedido_datacadastro']) ?>
                        </td>
                        <td>
                            <?= $dado['pedido_cep'] ?>
                        </td>
                        <td>
                            <?= $dado['pedido_estado'] ?>
                        </td>
                        <td>
                            <?= $dado['pedido_cidade'] ?>
                        </td>
                        <td>
                            <?= $dado['pedido_bairro'] ?>
                        </td>
                        <td>
                            <?= $dado['pedido_rua'] ?>
                        </td>
                        <td>
                            <?= $dado['pedido_numero'] ?>
                        </td>
                        <td>
                        <?= $dado['pedido_observacao'] ?>
                        </td>
                        <td>
                            <?= formatar_data($dado['pedido_data_retirada']) ?>
                        </td>
                        <td>
                            <?php if ($dado['pedido_status'] == 0): ?>
                                <span class="btn btn-success btn-xs">Finalizado</span>
                            <?php else: ?>
                                <span class="btn btn-primary btn-xs">Ativo</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center"><a id="finalizar"
                                href="<?= base_url() ?>Pedidos/finalizar/<?= $dado['pedido_id'] ?>"
                                class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
                            <a href="<?= base_url() ?>Pedidos/editar/<?= $dado['pedido_id'] ?>"
                                class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                    <tbody>
                    </tbody>

                <?php endforeach ?>
            </table>
        </div>
    </div>

</div>