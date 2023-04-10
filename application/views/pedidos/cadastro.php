<div class="content">
    <div class="titulo">
        <h5>Cadastro Pedidos</h5>
    </div>
    <script src="<?php echo base_url('js/pedidos.js'); ?>"></script>
    <div class='corpo'>
        <div class="col-md-12">

            <?php if (isset($pedidos)): ?>
                <form action="<?= base_url() ?>pedidos/update/<?= $pedidos['id'] ?>" method="post">
                <?php else: ?>
                    <form action="<?= base_url() ?>pedidos/store" method="post">
                    <?php endif; ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Nome">Nome:</label>
                            <input type="text" class="form-control small-text" name="nome" id="nome"
                                value="<?= isset($pedidos['nome_cliente']) ? $pedidos['nome_cliente'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Telefone">Telefone:</label>
                            <input type="text" class="form-control small-text" name="telefone" id="telefone"
                                value="<?= isset($pedidos['telefone_pedido']) ? $pedidos['telefone_pedido'] : '' ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Cep">Cep:</label>
                            <input type="text" class="form-control small-text" name="cep" id="cep"
                                value="<?= isset($pedidos['cep_pedido']) ? $pedidos['cep_pedido'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Estado">Estado:</label>
                            <input type="text" class="form-control small-text" name="estado" id="estado"
                                value="<?= isset($pedidos['estado_pedido']) ? $pedidos['estado_pedido'] : '' ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Cidadde">Cidade:</label>
                            <input type="text" class="form-control small-text" name="cidade" id="cidade"
                                value="<?= isset($pedidos['cidade_pedido']) ? $pedidos['cidade_pedido'] : '' ?>"
                                required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Bairro">Bairro:</label>
                            <input type="text" class="form-control small-text" name="bairro" id="bairro"
                                value="<?= isset($pedidos['bairro_pedido']) ? $pedidos['bairro_pedido'] : '' ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Rua">Rua:</label>
                            <input type="text" class="form-control small-text" name="rua" id="rua"
                                value="<?= isset($pedidos['rua_pedido']) ? $pedidos['rua_pedido'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Numero">Número</label>
                            <input type="text" class="form-control small-text" name="numero" id="numero"
                                value="<?= isset($pedidos['numero_pedido']) ? $pedidos['numero_pedido'] : '' ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="Situacao">Produto</label>
                            <select class="form-control select" name="produto" id="produto">
                                <option value="">Selecione</option>
                                <?php if (isset($produto)) { ?>
                                    <?php foreach ($produto as $value) { ?>
                                        <?php $selected = isset($pedidos["id_produto_pedido"]) && $value['id'] == $pedidos["id_produto_pedido"] ? ' selected ' : ''; ?>
                                        <option <?= $selected; ?> data-value="<?php echo $value['preco']; ?>"
                                            data-quantidade="<?php echo $value['quantidade_produto']; ?>"
                                            data-fornecedor="<?php echo $value['id_fornecedor_produto']; ?>"
                                            value="<?php echo $value['id']; ?>"><?php echo $value['nome_produto']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Quantidade">Quantidade</label>
                            <input type="number" class="form-control small-text" name="quantidade" id="quantidade"
                                value="<?= isset($pedidos['quantidade']) ? $pedidos['quantidade'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Situacao">Fornecedor</label>
                            <select class="form-control select" name="fornecedor" id="fornecedor">
                                <option value="">Selecione</option>
                                <?php if (isset($fornecedor)) { ?>
                                    <?php foreach ($fornecedor as $value) { ?>
                                        <?php $selected = isset($pedidos["id_fornecedor_pedido"]) && $value['id'] == $pedidos["id_fornecedor_pedido"] ? ' selected ' : ''; ?>
                                        <option <?= $selected; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Valor">Valor:</label>
                            <input type="text" class="form-control small-text " name="valor" id="valor"
                                value="<?= isset($pedidos['valor']) ? $pedidos['valor'] : '' ?>" required>
                        </div>
                    </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="valor_total">Total:</label>
                    <input type="text" class="form-control small-text" name="valor_total" id="valor_total"
                        value="<?= isset($pedidos['valor_total']) ? $pedidos['valor_total'] : '' ?>" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="FormaPagamento">Forma de Pagamento:</label>
                    <select class="form-control small-text" name="forma_pagamento" id="forma_pagamento" required>
                        <option value="">Selecione</option>
                        <option <?= isset($pedidos['forma_pagamento']) && $pedidos['forma_pagamento'] == 'dinheiro' ? ' selected' : '' ?> value="dinheiro">Dinheiro
                        </option>
                        <option <?= isset($pedidos['forma_pagamento']) && $pedidos['forma_pagamento'] == 'cartao' ? ' selected' : '' ?> value="cartao">Cartão
                        </option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="DataRetirada">Data Retirada:</label>
                    <input type="datetime-local" class="form-control small-text" name="data_retirada" id="data_retirada"
                        value="<?= isset($pedidos['data_retirada']) ? $pedidos['data_retirada'] : '' ?>" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="Observacao">Observação</label>
                    <textarea class="form-control small-text" name="observacao" id="observacao" cols="30"
                        rows="2"> <?= isset($pedidos['observacao']) ? $pedidos["observacao"] : "" ?></textarea>
                </div>
            </div>


            <div class="col-md-12">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                <a href="<?= base_url() ?>pedidos/index" class="btn btn-danger"><i class="fa fa-times"></i>
                    Cancelar</a>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- Mensagens  -->
<?php if ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?php echo $this->session->flashdata('error'); ?>'
        })
    </script>
<?php endif; ?>
<!-- update -->
<?php if ($this->session->flashdata('update')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Não foi possível atualizar o produto!'
        })
    </script>
<?php endif; ?>