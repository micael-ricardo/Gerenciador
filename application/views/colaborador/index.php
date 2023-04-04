<div class="content">
    <div class="titulo">
        <h5>Colaboradores</h5>
        <script src="<?php echo base_url('js/colaborador.js'); ?>"></script>
        <script>
            var excluirUrl = "<?php echo base_url('Colaborador/delete'); ?>";
        </script>
        <!-- adc e #filtro -->
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <a href="<?= base_url() ?>colaborador/cadastro" class="btn btn-success">Adicionar</a>
                    <button class="btn btn-info" type="button" id="div-filtro"
                        onclick="return($('#filtro').toggle('fade'))">
                        <i class="fa fa-filter"></i> Filtros
                    </button>
                </div>
            </div>
        <!--  filtros -->
        <div class="panel panel-inverse" id="filtro" style=" display: none;">
            <form method="get" autocomplete="off">
                <div class="form-group col-sm-12" style="margin-top: 10px;">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" class="form-control small-text" name="nome" id="nome" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Documento:</label>
                            <input type="text" class="form-control small-text" name="documento" id="documento" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Telefone:</label>
                            <input type="text" class="form-control small-text" name="telefone" id="telefone" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Cep:</label>
                            <input type="text" class="form-control small-text" name="cep" id="cepFiltro" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Bairro:</label>
                            <input type="text" class="form-control small-text" name="bairro" id="bairro" />
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Rua:</label>
                            <input type="text" class="form-control small-text" name="rua" id="rua" />
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Numero:</label>
                                    <input type="text" class="form-control small-text" name="numero" id="numero" />
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="Status">Status:</label>
                                    <select class="form-control small-text" name="status" id="status">
                                        <option value="">Selecione</option>
                                        <option value="1">Ativo</option>
                                        <option value="2">Inativo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                    <div class="row">
                            <div class="col-sm-6">
                        <div class="form-group">
                            <label for="TipoColaborador">Tipo Colaborador:</label>
                            <select class="form-control small-text" name="tipo_colaborador" id="tipo_colaborador">
                                <option value="">Selecione</option>
                                <option value="Funcionario">Funcionário</option>
                                <option value="Fornecedor">Fornecedor</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="TipoPessoa">Tipo Pessoa:</label>
                            <select class="form-control small-text" name="tipo_pessoa" id="tipo_pessoa">
                                <option value="">Selecione</option>
                                <option value="2">Fisica</option>
                                <option value="1">Jurídica</option>
                            </select>
                        </div>
                    </div>
                </div>
                </div>
                </div>

                <button type="submit" id="botao_filtrar" class="btn btn-primary">
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
                <h5>Certeza que deseja inativar: <b><span id="nome-usuario"></span> </b>?</h5>
                <hr>
                <p><b>ATENÇÃO:</b> Se você confirmar, não será possível editar esse colaborador posteriormente.</p>
                <form id="confirmar-exclusao" method="POST" action="<?= base_url() ?>Colaborador/delete">
                    <input type="hidden" name="id">
                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Confirmar</button>
                    <a href="<?= base_url() ?>Colaborador/index" type="button" class="btn btn-primary"><i
                            class="fa fa-times"></i>
                        Cancelar</a>
                </form>
            </div>
        </div>
        <!-- fim modal e incio data table -->
        <div class="tabela-responsive">
            <table id="consultar_usuarios" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Documento</th>
                        <th>Telefone</th>
                        <th>Cep</th>
                        <th>Estado</th>
                        <th>Cidade</th>
                        <th>Bairro</th>
                        <th>Rua</th>
                        <th>Numero</th>
                        <th>Tipo Colaborador</th>
                        <th>Tipo Pessoa</th>
                        <th>Data Cadastro</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

</div>