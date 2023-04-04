<div class="content">
    <div class="titulo">
        <h2>Cadastro Usuarios</h2>
    </div>
    <script src="<?php echo base_url('js/usuarios.js'); ?>"></script>
    <div class='corpo'>
        <div class="col-md-12">
            <?php if ($this->session->flashdata('error')): ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '<?php echo $this->session->flashdata('error'); ?>'
                    })
                </script>
            <?php endif; ?>

            <?php if (isset($usuario)): ?>
                <form action="<?= base_url() ?>Usuarios/update/<?= $usuario['id'] ?>" method="post">
                <?php else: ?>
                    <form action="<?= base_url() ?>Usuarios/store" method="post">
                    <?php endif; ?>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Nome">Nome:</label>
                            <input type="text" class="form-control" name="nome" id="nome"
                                value="<?= isset($usuario['nome']) ? $usuario['nome'] : '' ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Login">Usuario:</label>
                            <input type="text" class="form-control" name="login" id="login"
                                value="<?= isset($usuario['login']) ? $usuario['login'] : '' ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Email">E-mail:</label>
                            <input type="text" class="form-control" name="email" id="email"
                                value="<?= isset($usuario['email']) ? $usuario['email'] : '' ?>" required>
                        </div>
                    </div>

                    <?php if (isset($usuario)) { ?>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="alterarSenha">Deseja alterar senha ?</label>
                            <input type="checkbox" value="1" onclick="return($('#filtro').toggle('fade'))"
                                name="alterarSenha" id="alterarSenha">
                        </div>
                    </div>

                  
                    <div id="filtro" style="display: none;">
                    <?php } ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Senha">Senha:</label>
                                <input type="password" class="form-control" name="senha" id="senha">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Senha">Confirma Senha:</label>
                                <input type="password" class="form-control" name="confirma" id="confirma">
                            </div>
                        </div>
                        <span class="input-group-text-usuario" id="olho">
                            <i class="fa fa-eye"></i>
                            <?php if (isset($usuario)) { ?>
                        </div>
                        <?php } ?>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
            <a href="<?= base_url() ?>Usuarios/index" class="btn btn-danger"><i class="fa fa-times"></i>
                Cancelar</a>
        </div>

        </form>
    </div>
</div>