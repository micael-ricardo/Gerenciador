<div class="content">
    <div class="titulo">
        <h2>Cadastro Produtos</h2>
    </div>

    <div class='corpo'>
        <div class="col-md-12">
 
                    <form action="<?= base_url() ?>produtos/store" method="post">
          
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Nome">Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome"
                                value="<?= isset($produto) ? $produto["nome"] : "" ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Preco">Preço</label>
                            <input type="text" class="form-control" name="preco" id="preco" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Quantidade">Quantidade</label>
                            <input type="number" class="form-control" name="quantidade" id="quantidade" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="data">Data Cadastro</label>
                            <input type="text" class="form-control" name="data" id="data" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="Categoria">Categoria</label>
                            <input type="text" class="form-control" name="categoria" id="categoria" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Descricao">Descrição</label>
                            <textarea class="form-control" name="descricao" id="descricao" cols="30"
                                rows="10"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="ativo" value="0">


                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        <a href="<?= base_url() ?>produtos" class="btn btn-danger"><i class="fa fa-times"></i>
                            Cancelar</a>
                    </div>
        </div>

        </form>
    </div>
</div>