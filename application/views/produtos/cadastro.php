<div class="content">
    <div class="titulo">
        <h2>Cadastro Produtos</h2>
    </div>
    <script src="<?php echo base_url('js/produtos.js'); ?>"></script>
    <div class='corpo'>
        <div class="col-md-12">
            <?php if (isset($produto)): ?>
                <form action="<?= base_url() ?>produtos/update/<?= $produto['id'] ?>" method="post">
                <?php else: ?>
                    <form action="<?= base_url() ?>produtos/store" method="post">
                    <?php endif; ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Nome">Nome</label>
                            <input type="text" class="form-control" name="nome" id="nome"
                                value="<?= isset($produto) ? $produto["nome"] : "" ?>" required>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="Situacao">Fornecedor</label>
                            <select class="form-control select2" name="fornecedor" id="fornecedor">
                                <option value="">Selecione</option>
                                <?php if (isset($fornecedor)) {  ?>
                                    <?php foreach ($fornecedor as $value) { ?>
                                        <?php $selected = isset($produto["id_fornecedor"]) && $value['id'] == $produto["id_fornecedor"] ? ' selected ' : ''; ?>
                                        <option   <?= $selected; ?> value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Preco">Preço</label>
                            <input type="text" class="form-control" name="preco" id="preco" value="<?= isset($produto) ? $produto["preco"] : "" ?>" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="Quantidade">Quantidade</label>
                            <input type="number" class="form-control" name="quantidade" id="quantidade"  value="<?= isset($produto) ? $produto["quantidade"] : "" ?>" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="Descricao">Descrição</label>
                            <textarea class="form-control" name="descricao" id="descricao" cols="30"
                                rows="10"> <?= isset($produto) ? $produto["descricao"] : "" ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
                        <a href="<?= base_url() ?>produtos" class="btn btn-danger"><i class="fa fa-times"></i>
                            Cancelar</a>
                    </div>
        </div>

        </form>
    </div>
</div>