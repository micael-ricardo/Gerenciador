<div class="content">
    <div class="titulo">
        <h2>Usuários</h2>
        <form action="<?= base_url() ?>colaborador/pesquisar" method="get" autocomplete="off">
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <a class="btn btn-primary" data-toggle="modal"
                        data-target=".modal-passagem" id='cadastropassagem'>Adicionar</a>
                    <input type="text" class="form-pesquisa" name="Pesquisa" id="Pesquisa" placeholder="Pesquisar...">
                    <button class="btn btn-primary" type="submit" id="button-addon1">
                        <i class="fa fa-search"></i> Pesquisar
                    </button>
                    <button class="btn btn-info" type="button" id="div-filtro"
                        onclick="return($('#filtro').toggle('fade'))">
                        <i class="fa fa-filter"></i> Mais Filtros
                    </button>
                </div>
            </div>

        </form>


        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form-cadastro">Iniciar atendimento</button>


        <form name="" action="" method="post" autocomplete="off" id="form-cadastro"
            class="modal fade bd-example-modal-lg modal-passagem" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Iniciar atendimento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <div class="form-row">
                            <div class="col-sm-12 form-group">
                                <label>Venda <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="VendasId" id="VendasId" />
                                <input type="text" class="form-control VendasClientesId" name="VendasClientesId"
                                    id="VendasClientesId" required />
                            </div>
                            <div class="col-sm-6 form-group">
                                <label>Data Inicio <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="DataInicialModal" id="DataInicialModal"
                                    max="<?= date('Y-m-d') ?>" required />
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Hora Inicio<span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="HoraInicial" id="HoraInicial" min="00:00"
                                    max="23:59" required />
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Data Final</label>
                                <input type="date" class="form-control" name="DataFinalModal" id="DataFinalModal"
                                    max="<?= date('Y-m-d') ?>" />
                            </div>

                            <div class="col-sm-6 form-group">
                                <label>Hora Final</label>
                                <input type="time" class="form-control" name="HoraFinal" id="HoraFinal" min="00:00"
                                    max="23:59" />
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="icon ti-close"></i> Cancelar
                        </button>
                        <button type="submit" id='teste' class="btn btn-primary">
                            <i class="fa fa-save"></i> Salvar
                        </button>
                    </div>
                </div>
            </div>
        </form>




        <div class="panel panel-inverse" id="filtro" style="display: none;">
            <div class="panel-body">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <input type="text" class="form-control" name="PesquisaVendasId"
                                        id="PesquisaVendasId" />

                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Data Inicio</label>
                                    <input type="date" class="form-control" name="DataInicial" id="DataInicial"
                                        required />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Data Final</label>
                                    <input type="date" class="form-control" name="DataFinal" id="DataFinal" required />
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </form>

    </div>

    <div class='corpo'>
        <div class="tabela-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>E-mail</th>
                        <th>Data cadastro</th>
                        <th style="text-align: center;">Ações</th>
                    </tr>
                </thead>
                <tr>
                    <?php foreach ($dados as $dado): ?>

                        <td>
                            <?= $dado['nome'] ?>
                        </td>
                        <td>
                            <?= $dado['login'] ?>
                        </td>
                        <td>
                            <?= $dado['email'] ?>
                        </td>
                        <td>
                            <?= $dado['datacadastro'] ?>
                        </td>
                        <td style="text-align: center"><a id="remover"
                                href="<?= base_url() ?>colaborador/delete/<?= $dado['id'] ?>" class="btn btn-danger"><i
                                    class="fa fa-trash"></i></a>
                            <a href="<?= base_url() ?>colaborador/editar/<?= $dado['id'] ?>" class="btn btn-info"><i
                                    class="fa fa-pencil"></i></a>
                        </td>
                    </tr>
                    <tbody>
                    </tbody>
                <?php endforeach ?>
            </table>
        </div>
    </div>

</div>

<script type="text/javascript">


    $(document).ready(function () {
        $('.table').DataTable({
            "language": {
                "url": "<?php echo base_url('public/datatable/Portuguese-Brasil.json'); ?>"
            },
            "scrollY": "350px",
            "paging": false,
            "searching": false,
            "ordering": false
        });
    });
</script>