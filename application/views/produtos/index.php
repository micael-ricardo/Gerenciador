    <div class="content">
        <div class="titulo">
            <h2>Produtos</h2>
        </div>

        <div class='corpo'>
            <table id="tabela-produtos">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Quantidade em Estoque</th>
                        <th>Categoria</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach ($produtos as $produto): ?>

                            <td>
                                <?= $produto['nome_do_produto'] ?>
                            </td>
                            <td>
                                <?= $produto['descricao'] ?>
                            </td>
                            <td>
                                <?= reais($produto['preco']) ?>
                            </td>
                            <td>
                                <?= $produto['quantidade_em_estoque'] ?>
                            </td>
                            <td>
                                <?= $produto['categoria'] ?>
                            </td>
                            <td><a href="<?= base_url('produtos/delete/'.$produto['id'])?>" class="btn btn-danger">Deletar</a></td>

                        </tr>
                    </tbody>
                <?php endforeach ?>
            </table>
        </div>
    </div>

