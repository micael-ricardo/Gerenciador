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
                            <input type="text" class="form-control small-text" name="nome" id="nome"
                                value="<?=  $this->session->flashdata('nome') !== NULL ? $this->session->flashdata('nome') : (isset($usuario['nome']) ? $usuario['nome'] : '') ?>"
                                required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Login">Usuario:</label>
                            <input type="text" class="form-control small-text" name="login" id="login"
                                value="<?=  $this->session->flashdata('login') !== NULL ? $this->session->flashdata('login') : (isset($usuario['login']) ? $usuario['login'] : '') ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Email">E-mail:</label>
                            <input type="text" class="form-control small-text" name="email" id="email"
                                value="<?= $this->session->flashdata('email') !== NULL ? $this->session->flashdata('email') : (isset($usuario['email']) ? $usuario['email'] : '') ?>"
                                required>
                        </div>
                    </div>
                    <?php if (isset($usuario)) { ?>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="alterarSenha">Deseja alterar senha ?</label>
                                <input type="checkbox" value="1" onclick="return($('#AlterarSenha').toggle('fade'))"
                                    name="alterarSenha" id="alterarSenha">
                            </div>
                        </div>


                        <div id="AlterarSenha" style="display: none;">
                        <?php } ?>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Senha">Senha:</label>
                                <input type="password" class="form-control small-text" name="senha" id="senha">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Senha">Confirma Senha:</label>
                                <input type="password" class="form-control small-text" name="confirma" id="confirma">
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
            title: 'Não foi possível atualizar o Usuario!'
        })
    </script>
<?php endif; ?>