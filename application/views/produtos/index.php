<div class="content">
    <div class="titulo">
        <h5>Produtos</h5>
        <script src="<?php echo base_url('js/produtos.js'); ?>"></script>
        <script>
            var excluirUrl = "<?php echo base_url('Produtos/delete'); ?>";
        </script>
        <!-- adc e #filtro -->
        <div class="input-group mb-3">
            <div class="input-group-append">
                <a href="<?= base_url() ?>produtos/cadastro" class="btn btn-success">Adicionar</a>
                <button class="btn btn-info" type="button" id="div-filtro"
                    onclick="return($('#filtro').toggle('fade'))">
                    <i class="fa fa-filter"></i> Filtros
                </button>
            </div>
        </div>

        <div class="panel panel-inverse" id="filtro" style="display: none;">
            <form method="get" autocomplete="off">
                <div class="form-group col-sm-12" style="margin-top: 10px;">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="nome" id="nome" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Preço:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="preco" id="preco" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Quantidade:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="quantidade"
                                id="quantidade" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="Status">Status:</label>
                            <select class="form-control selects" style="height: 30px;" name="status" id="status">
                                <option value="">Selecione</option>
                                <option value="1">Ativo
                                </option>
                                <option value="0">Inativo
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Descrição:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="descricao"
                                id="descricao" />
                        </div>
                    </div>
                </div>
                <button type="submit" id="botao_filtrar" class="btn btn-primary ">
                    <i class="fa fa-search"></i> Pesquisar
                </button>
        </div>
        </form>
    </div>
    <div class='corpo'>

        <!-- Modal de exluir    -->

        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h5>Certeza que deseja inativar: <b><span id="nome-usuario"></span> </b>?</h5>
                <hr>
                <p><b>ATENÇÃO:</b> Se você confirmar, não será possível editar esse produto posteriormente.</p>
                <form id="confirmar-exclusao" method="POST" action="<?= base_url() ?>produtos/delete">
                    <input type="hidden" name="id">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Confirmar</button>
                    <a href="<?= base_url() ?>Produtos/index" type="button" class="btn btn-primary"><i
                            class="fa fa-times"></i>
                        Cancelar</a>
                </form>
            </div>
        </div>

        <div class="tabela-responsive">
            <table id="consultar_usuarios" class="table table-striped" style="width: 100%">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Descrição</th>
                        <th>Fornecedor</th>
                        <th>Telefone</th>
                        <th>Data Cadastro</th>
                        <th>Status</th>
                        <th style="text-align: center">Ação</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Mensagens  -->
<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Produto cadastrado com sucesso!'
        })
    </script>
<?php endif; ?>

<!-- update -->
<?php if ($this->session->flashdata('update')): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Produto atualizado com sucesso!'
        })
    </script>
<?php endif; ?>