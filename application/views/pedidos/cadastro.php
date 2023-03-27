<div class="content">
    <div class="titulo">
        <h2>Cadastro Pedidos</h2>
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
                            <input type="text" class="form-control" name="nome" id="nomes"
                                value="<?= isset($pedidos['nome']) ? $pedidos['nome'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Produto">Produto:</label>
                            <input type="text" class="form-control" name="produto" id="produto"
                                value="<?= isset($pedidos['produto']) ? $pedidos['produto'] : '' ?>" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Telefone">Telefone:</label>
                            <input type="text" class="form-control" name="telefone" id="telefone"
                                value="<?= isset($pedidos['telefone']) ? $pedidos['telefone'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Valor">Valor:</label>
                            <input type="text" class="form-control" name="valor" id="valor"
                                value="<?= isset($pedidos['valor']) ? $pedidos['valor'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Cep">Cep:</label>
                            <input type="text" class="form-control" name="cep" id="cep"
                                value="<?= isset($pedidos['cep']) ? $pedidos['cep'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Estado">Estado:</label>
                            <input type="text" class="form-control" name="estado" id="estado"
                                value="<?= isset($pedidos['estado']) ? $pedidos['estado'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Cidadde">Cidade:</label>
                            <input type="text" class="form-control" name="cidade" id="cidade"
                                value="<?= isset($pedidos['cidade']) ? $pedidos['cidade'] : '' ?>" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Bairro">Bairro:</label>
                            <input type="text" class="form-control" name="bairro" id="bairro"
                                value="<?= isset($pedidos['bairro']) ? $pedidos['bairro'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Rua">Rua:</label>
                            <input type="text" class="form-control" name="rua" id="rua"
                                value="<?= isset($pedidos['rua']) ? $pedidos['rua'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Numero">Número</label>
                            <input type="text" class="form-control" name="numero" id="numero"
                                value="<?= isset($pedidos['numero']) ? $pedidos['numero'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="DataRetirada">Data Retirada:</label>
                            <input type="datetime-local" class="form-control" name="data_retirada" id="data_retirada"
                                value="<?= isset($pedidos['data_retirada']) ? $pedidos['data_retirada'] : '' ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="FormaPagamento">Forma de Pagamento:</label>
                            <select class="form-control selects" name="forma_pagamento" id="forma_pagamento" required>

                                <option value="">Selecione</option>
                                <option <?= isset($pedidos['forma_pagamento']) && $pedidos['forma_pagamento'] == 'dinheiro' ? ' selected' : '' ?> value="dinheiro">Dinheiro
                                </option>
                                <option <?= isset($pedidos['forma_pagamento']) && $pedidos['forma_pagamento'] == 'cartao' ? ' selected' : '' ?> value="cartao">Cartão
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        <a href="<?= base_url() ?>pedidos" class="btn btn-danger"><i class="fa fa-times"></i>
                            Cancelar</a>
                    </div>
        </div>

        </form>
    </div>
</div>