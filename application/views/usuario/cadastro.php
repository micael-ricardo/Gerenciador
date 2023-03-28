<div class="content">
    <div class="titulo">
        <h2>Cadastro Usuarios</h2>
    </div>
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

            <?php if (isset($Usuarios)): ?>
                <form action="<?= base_url() ?>Usuarios/update/<?= $Usuarios['id'] ?>" method="post">
                <?php else: ?>
                    <form action="<?= base_url() ?>Usuarios/store" method="post">
                    <?php endif; ?>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Nome">Nome:</label>
                            <input type="text" class="form-control" name="nome" id="nome"
                                value="<?= isset($Usuarios['nome']) ? $Usuarios['nome'] : '' ?>" required>
                        </div>
                    </div>

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
                            <input type="password" class="form-control" name="senha" id="senha">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="Senha">Confirma Senha:</label>
                            <input type="password" class="form-control" name="confirma" id="confirma">
                        </div>
                    </div>


                    <span class="input-group-text-usuario" id="olho-usuario">
                        <i class="fa fa-eye"></i>
        </div>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
            <a href="<?= base_url() ?>Usuarios" class="btn btn-danger"><i class="fa fa-times"></i>
                Cancelar</a>
        </div>

        </form>
    </div>
</div>