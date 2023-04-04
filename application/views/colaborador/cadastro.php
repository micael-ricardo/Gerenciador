<div class="content">
    <div class="titulo">
        <h5>Cadastro Colaborador</h5>
    </div>
    <script src="<?php echo base_url('js/colaborador.js'); ?>"></script>
    <div class='corpo'>

        <?php if (isset($colaborador)): ?>
            <form action="<?= base_url() ?>colaborador/update/<?= $colaborador['id'] ?>" method="post">
            <?php else: ?>
                <form action="<?= base_url() ?>colaborador/store" method="post">
                <?php endif; ?>
                <div class="col-md-12" style="margin-top: 10px;margin-bottom: 15px;">
                    <label for="tipo_pessoa_pf">
                        <input type="radio" id="tipo_pessoa_pf" name="tipo_pessoa" value="2" <?php echo (!isset($colaborador) || $colaborador['tipo_pessoa'] == 2) ? 'checked' : ''; ?> <?php echo (isset($colaborador)  &&  $colaborador['tipo_pessoa'] == 1) ? 'disabled' : ''; ?>> Pessoa Fisica
                    </label>
                    <label for="tipo_pessoa_pj">
                        <input type="radio" id="tipo_pessoa_pj" name="tipo_pessoa" value="1" <?php echo (isset($colaborador) && $colaborador['tipo_pessoa'] == 1) ? 'checked' : ''; ?> <?php echo  (isset($colaborador)  &&  $colaborador['tipo_pessoa'] == 2) ? 'disabled' : ''; ?>> Pessoa Jurídica
                    </label>
                </div>
                <div id="pessoa_fisica" style="display:none">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Nome">Nome:</label>
                            <input type="text" class="form-control" name="nome" id="nomes"
                                value="<?= isset($colaborador['nome']) ? $colaborador['nome'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Documento">CPF:</label>
                            <input type="text" class="form-control" name="documento" id="cpf"
                                value="<?= isset($colaborador['documento']) ? $colaborador['documento'] : '' ?>">
                        </div>
                    </div>
                </div>

                <div id="pessoa_juridica" style="display:none">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Nome">Razão Social:</label>
                            <input type="text" class="form-control" name="razao_social" id="razao_social"
                                value="<?= isset($colaborador['nome']) ? $colaborador['nome'] : '' ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Documento">CNPJ:</label>
                            <input type="text" class="form-control" name="cnpj" id="cnpj"
                                value="<?= isset($colaborador['documento']) ? $colaborador['documento'] : '' ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Telefone">Telefone:</label>
                        <input type="text" class="form-control" name="telefone" id="telefone"
                            value="<?= isset($colaborador['telefone']) ? $colaborador['telefone'] : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Cep">Cep:</label>
                        <input type="text" class="form-control" name="cep" id="cep"
                            value="<?= isset($colaborador['cep']) ? $colaborador['cep'] : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Estado">Estado:</label>
                        <input type="text" class="form-control" name="estado" id="estado"
                            value="<?= isset($colaborador['estado']) ? $colaborador['estado'] : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Cidadde">Cidade:</label>
                        <input type="text" class="form-control" name="cidade" id="cidade"
                            value="<?= isset($colaborador['cidade']) ? $colaborador['cidade'] : '' ?>" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" id="bairro"
                            value="<?= isset($colaborador['bairro']) ? $colaborador['bairro'] : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Rua">Rua:</label>
                        <input type="text" class="form-control" name="rua" id="rua"
                            value="<?= isset($colaborador['rua']) ? $colaborador['rua'] : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="Numero">Número</label>
                        <input type="text" class="form-control" name="numero" id="numero"
                            value="<?= isset($colaborador['numero']) ? $colaborador['numero'] : '' ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="TipoColaborador">Tipo Colaborador:</label>
                        <select class="form-control selects" name="tipo_colaborador" id="tipo_colaborador" required>

                            <option value="">Selecione</option>
                            <option <?= isset($colaborador['tipo_colaborador']) && $colaborador['tipo_colaborador'] == 'Funcionario' ? ' selected' : '' ?>
                                value="Funcionario">Funcionário
                            </option>
                            <option <?= isset($colaborador['tipo_colaborador']) && $colaborador['tipo_colaborador'] == 'Fornecedor' ? ' selected' : '' ?> value="Fornecedor">
                                Fornecedor
                            </option>
                        </select>
                    </div>
                </div>

                <?php if (!isset($colaborador)): ?>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cadastrarusuario">Deseja cadastrar o Usuario?</label>
                            <input type="checkbox" value="1" onclick="return($('#CadastroUsuario').toggle('fade'))"
                                name="cadastrarusuario" id="cadastrarusuario">
                        </div>
                    </div>
                    <div class="row">
                        <div id="CadastroUsuario" class="col-md-12" style="display: none;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Login">Login:</label>
                                    <input type="text" class="form-control" name="login" id="login">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Email">E-mail:</label>
                                    <input type="text" class="form-control" name="email" id="email">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Senha">Senha:</label>
                                    <input type="password" class="form-control" name="senha" id="senha">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="ConfirmarSenha">Confirmar Senha:</label>
                                    <input type="password" class="form-control" name="corfirma" id="corfirma">
                                </div>
                            </div>

                            <span class="input-group-text" id="olho">
                                <i class="fa fa-eye"></i>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                    <a href="<?= base_url() ?>Colaborador/index" class="btn btn-danger"><i class="fa fa-times"></i>
                        Cancelar</a>
                </div>

            </form>

    </div>

</div>