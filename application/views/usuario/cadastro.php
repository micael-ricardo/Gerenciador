<div class="content">
    <div class="titulo">
        <h2>Cadastro Colaborador</h2>
    </div>

    <div class='corpo'>
        <div class="col-md-12">

            <?php if (isset($colaborador)): ?>
                <form action="<?= base_url() ?>colaborador/update/<?= $colaborador['id'] ?>" method="post">
                <?php else: ?>
                    <form action="<?= base_url() ?>colaborador/store" method="post">
                    <?php endif; ?>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Nome">Nome:</label>
                            <input type="text" class="form-control" name="nome" id="nome" value="<?=isset($colaborador['nome']) ? $colaborador['nome'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Documento">Documento:</label>
                            <input type="text" class="form-control" name="documento" id="documento" value="<?=isset($colaborador['documento']) ? $colaborador['documento'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Telefone">Telefone:</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" value="<?=isset($colaborador['telefone']) ? $colaborador['telefone'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Cep">Cep:</label>
                            <input type="text" class="form-control" name="cep" id="cep" value="<?=isset($colaborador['cep']) ? $colaborador['cep'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Rua">Rua:</label>
                            <input type="text" class="form-control" name="rua" id="rua"  value="<?=isset($colaborador['rua']) ? $colaborador['rua'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Bairro">Bairro:</label>
                            <input type="text" class="form-control" name="bairro" id="bairro" value="<?=isset($colaborador['bairro']) ? $colaborador['bairro'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Numero">Numero</label>
                            <input type="text" class="form-control" name="numero" id="numero"  value="<?=isset($colaborador['numero']) ? $colaborador['numero'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="TipoColaborador">Tipo Colaborador:</label>
                            <select class="form-control selects" name="tipo_colaborador" id="tipo_colaborador" required>
                           
                                <option value="">Selecione</option>
                                <option  <?= isset($colaborador['tipo_colaborador']) &&  $colaborador['tipo_colaborador'] =='0' ?' selected' : '' ?>  value="0">Funcionário</option>
                                <option  <?= isset($colaborador['tipo_colaborador']) &&  $colaborador['tipo_colaborador'] =='1' ?' selected' : '' ?>  value="1">Fornecedor</option>
                            </select>
                        </div>
                    </div>

                    <?php if (!isset($colaborador)): ?>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="cadastrarusuario">Deseja cadastrar o Usuario?</label>
                            <input type="checkbox" value="1" onclick="return($('#filtro').toggle('fade'))"
                                name="cadastrarusuario" id="cadastrarusuario">
                        </div>
                    </div>
                    <div id="filtro" style="display: none;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Login">Usuario:</label>
                                <input type="text" class="form-control" name="login" id="login">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Email">E-mail:</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Senha">Senha:</label>
                                <input type="text" class="form-control" name="senha" id="senha">
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>



                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        <a href="<?= base_url() ?>colaborador" class="btn btn-danger"><i class="fa fa-times"></i>
                            Cancelar</a>
                    </div>
        </div>

        </form>
    </div>
</div>

<script>

    $(document).ready(function () {
        var $checkbox = $('#cadastrarusuario');
        $checkbox.click(function () {
            if ($checkbox.is(':checked')) {
                $('#login, #email, #senha').attr('required', true);
            } else {
                $('#login, #email, #senha').removeAttr('required');
            }
        });
    });


</script>