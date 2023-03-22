<div class="content">
    <div class="titulo">
        <h2>Cadastro Colaborador</h2>
    </div>

    <div class='corpo'>
        <div class="col-md-12">
        
                    <form action="<?= base_url() ?>colaborador/store" method="post">
              
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Nome">Nome:</label>
                            <input type="text" class="form-control" name="nome" id="nome" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Documento">Documento:</label>
                            <input type="text" class="form-control" name="documento" id="documento" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Telefone">Telefone:</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Cep">Cep:</label>
                            <input type="text" class="form-control" name="cep" id="cep" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Rua">Rua:</label>
                            <input type="text" class="form-control" name="rua" id="rua" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Bairro">Bairro:</label>
                            <input type="text" class="form-control" name="bairro" id="bairro" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Numero">Numero</label>
                            <input type="text" class="form-control" name="numero" id="numero" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        <label for="TipoColaborador">Tipo Colaborador:</label>
                        <select class="form-control selects" name="tipo_colaborador" id="tipo_colaborador" required>
                            <option value="">Selecione</option>
                            <option value="0">Funcionário</option>
                            <option value="1">Fornecedor</option>
                        </select>
                    </div>
                    </div>
               
                 
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="DataCadastro">Data Cadastro</label>
                            <input type="text" class="form-control" name="datacadastro" id="datacadastro" required>
                        </div>
                    </div>
         
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Login">Usuario:</label>
                            <input type="text" class="form-control" name="login" id="login" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Email">E-mail:</label>
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Senha">Senha:</label>
                            <input type="text" class="form-control" name="senha" id="senha" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="cadastrarusuario">Deseja cadastrar o Usuario?</label>
                            <input type="checkbox" value="1" name="cadastrarusuario" id="cadastrarusuario">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        <a href="<?= base_url() ?>colaborador" class="btn btn-danger"><i class="fa fa-times"></i>
                            Cancelar</a>
                    </div>
        </div>

        </form>
    </div>
</div>