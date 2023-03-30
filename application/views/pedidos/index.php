<div class="content">
    <div class="titulo">
        <h3>Pedidos</h3>
        <script src="<?php echo base_url('js/pedidos.js'); ?>"></script>
        <script>
            var finalizar = "<?php echo base_url('Pedidos/finalizar'); ?>";
        </script>
        <!-- filtro rapido -->
        <form id="filtro-rapido" method="get" autocomplete="off">
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <a href="<?= base_url() ?>Pedidos/cadastro" class="btn btn-success">Adicionar</a>
                    <input type="text" class="form-pesquisa" name="Pesquisa" id="Pesquisa"
                        placeholder="Filtrar Pelo Nome:">
                    <button class="btn btn-primary" type="submit" id="botao-pesquisar">
                        <i class="fa fa-search"></i> Pesquisar
                    </button>
                    <button class="btn btn-info" type="button" id="div-filtro"
                        onclick="return($('#filtro').toggle('fade'))">
                        <i class="fa fa-filter"></i> Mais Filtros
                    </button>
                </div>
            </div>
        </form>
        <!-- mais filtros -->
        <div class="panel panel-inverse" id="filtro" style=" display: none;">
            <form id="consulta" method="get" autocomplete="off">
                <div class="form-group col-sm-12" style="margin-top: 10px;">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" style="height: 30px;" class="form-control" name="nome" id="search" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Documento:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="documento"
                                id="documento" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Telefone:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="telefone"
                                id="telefone" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Cep:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="cep" id="cep" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Bairro:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="bairro" id="bairro" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Rua:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="rua" id="rua" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Numero:</label>
                            <input type="text" class="form-control" style="height: 30px;" name="numero" id="numero" />
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
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="TipoColaborador">Tipo Colaborador:</label>
                            <select class="form-control selects" style="height: 30px;" name="tipo_colaborador"
                                id="tipo_colaborador">
                                <option value="">Selecione</option>
                                <option value="0">Funcionário
                                </option>
                                <option value="1">Fornecedor
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="TipoPessoa">Tipo Pessoa:</label>
                            <select class="form-control selects" style="height: 30px;" name="tipo_pessoa"
                                id="tipo_pessoa">
                                <option value="">Selecione</option>
                                <option value="0">Fisica
                                </option>
                                <option value="1">Jurídica
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary ">
                    <i class="fa fa-search"></i> Pesquisar
                </button>
        </div>
        </form>
    </div>

    <div class='corpo'>
        <!-- Modal -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h5>O cliente: <b><span id="nome-usuario"></span></b> já pegou o pedido?</h5>
                <hr>
                <p><b>ATENÇÃO:</b> Se você confirmar, não será possível editar esse pedido posteriormente.</p>
                <form id="confirmar-finalizar" method="POST" action="<?= base_url() ?>Pedidos/finalizar">
                    <input type="hidden" name="id">
                    <button type="submit" class="btn btn-success"><i class="fa fa-trash"></i> Confirmar</button>
                    <a href="<?= base_url() ?>Pedidos" type="button" class="btn btn-danger"><i class="fa fa-times"></i>
                        Cancelar</a>
                </form>
            </div>
        </div>
        <!-- fim modal e incio data table -->

        <div class="tabela-responsive">
            <table id="consultar_pedidos" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <!-- <th>Telefone</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Valor Total</th>
                        <th>Forma de Pagamento</th>-->
                        <th>Fornecedor</th> 
                         <th>Data Cadastro</th>
                     <!--   <th>Cep</th>
                        <th>Estado</th>
                        <th>Cidade</th>
                        <th>Bairro</th>
                        <th>Rua</th>
                        <th>Número</th>
                         <th>Observação</th>
                        <th>Data Retirada</th>   
                        <th>Status</th>
                        <th style="text-align: center;">Ações</th>  -->
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>