<?php
// 1. O "CÉREBRO" - Processamento de Dados no Topo

$exibir_recibo = false;
$erros = [];
$dados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Tratamento de variáveis e limpeza contra códigos maliciosos (htmlspecialchars)
    $prestador     = htmlspecialchars(trim($_POST["prestador"] ?? ''));
    $documento     = htmlspecialchars(trim($_POST["documento"] ?? ''));
    $telefone      = htmlspecialchars(trim($_POST["telefone"] ?? ''));
    
    // Limpeza e Validação de E-mail no Back-end
    $email_bruto   = trim($_POST["email"] ?? '');
    $email         = filter_var($email_bruto, FILTER_SANITIZE_EMAIL);
    
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "O e-mail digitado não é válido. Por favor, verifique.";
    }

    $cliente       = htmlspecialchars(trim($_POST["cliente"] ?? ''));
    $endereco      = htmlspecialchars(trim($_POST["endereco"] ?? ''));
    $telefone_cli  = htmlspecialchars(trim($_POST["telefone_cliente"] ?? ''));
    $data          = htmlspecialchars(trim($_POST["data"] ?? ''));
    $horario       = htmlspecialchars(trim($_POST["horario"] ?? ''));
    
    $servicos      = $_POST["servico"] ?? []; 
    $observacoes   = htmlspecialchars(trim($_POST["observacoes"] ?? ''));
    $pagamento     = htmlspecialchars(trim($_POST["pagamento"] ?? ''));
    
    // Cálculos
    $valor_servico   = (float)($_POST["valor_servico"] ?? 0);
    $produtos        = (float)($_POST["produtos"] ?? 0);
    $desconto        = (float)($_POST["desconto"] ?? 0);
    $total_digitado  = (float)($_POST["total"] ?? 0);
    
    $total_calculado = $valor_servico + $produtos - $desconto;
    $total_final     = ($total_digitado > 0) ? $total_digitado : $total_calculado;

    // Se não houver erros, preparamos os dados para exibição
    if (empty($erros)) {
        $dados = [
            'prestador'      => $prestador,
            'documento'      => $documento,
            'telefone'       => $telefone,
            'email'          => $email,
            'cliente'        => $cliente,
            'endereco'       => $endereco,
            'telefone_cli'   => $telefone_cli,
            'data_formatada' => !empty($data) ? date('d/m/Y', strtotime($data)) : '---',
            'horario_formatado' => !empty($horario) ? $horario : '---',
            'servicos'       => $servicos,
            'observacoes'    => $observacoes,
            'pagamento'      => $pagamento,
            'valor_servico'  => $valor_servico,
            'produtos'       => $produtos,
            'desconto'       => $desconto,
            'total_final'    => $total_final
        ];
        $exibir_recibo = true;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestação de Serviço - Limpeza de Piscina</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>🏊 Prestação de Serviço - Limpeza de Piscina</h1>

    <?php if (!empty($erros)): ?>
        <div class="erro-msg">
            <ul>
                <?php foreach ($erros as $erro): ?>
                    <li><?php echo $erro; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="" method="post">

        <fieldset>
            <legend>Dados do Prestador</legend>
            <label for="prestador">Nome:*</label>
            <input type="text" id="prestador" name="prestador" required>

            <label for="documento">CPF/CNPJ:</label>
            <input type="text" id="documento" name="documento">

            <label for="telefone">Telefone:*</label>
            <input type="text" id="telefone" name="telefone" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email">
        </fieldset>

        <fieldset>
            <legend>Dados do Cliente</legend>

            <label for="cliente">Nome:*</label>
            <input type="text" id="cliente" name="cliente" required>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco">

            <label for="telefone_cliente">Telefone:</label>
            <input type="text" id="telefone_cliente" name="telefone_cliente">

            <label for="data">Data:*</label>
            <input type="date" id="data" name="data" required>

            <label for="horario">Horário:</label>
            <input type="time" id="horario" name="horario">
        </fieldset>

        <fieldset>
            <legend>Serviços Realizados</legend>

            <div class="checkbox-group">
                <label class="checkbox"><input type="checkbox" name="servico[]" value="Limpeza da superfície"> Limpeza da superfície</label>
                <label class="checkbox"><input type="checkbox" name="servico[]" value="Aspiração do fundo"> Aspiração do fundo</label>
                <label class="checkbox"><input type="checkbox" name="servico[]" value="Escovação das paredes"> Escovação das paredes</label>
                <label class="checkbox"><input type="checkbox" name="servico[]" value="Limpeza dos cestos"> Limpeza dos cestos</label>
                <label class="checkbox"><input type="checkbox" name="servico[]" value="Retrolavagem do filtro"> Retrolavagem do filtro</label>
                <label class="checkbox"><input type="checkbox" name="servico[]" value="Controle do pH"> Controle do pH</label>
                <label class="checkbox"><input type="checkbox" name="servico[]" value="Aplicação de cloro"> Aplicação de cloro</label>
                <label class="checkbox"><input type="checkbox" name="servico[]" value="Aplicação de algicida"> Aplicação de algicida</label>
            </div>
        </fieldset>

        <fieldset>
            <legend>Observações</legend>
            <textarea name="observacoes" rows="5"></textarea>
        </fieldset>

        <fieldset>
            <legend>Valores</legend>

            <label for="valor_servico">Valor do Serviço (R$):</label>
            <input type="number" step="0.01" id="valor_servico" name="valor_servico" value="0.00">

            <label for="produtos">Produtos Utilizados (R$):</label>
            <input type="number" step="0.01" id="produtos" name="produtos" value="0.00">

            <label for="desconto">Desconto (R$):</label>
            <input type="number" step="0.01" id="desconto" name="desconto" value="0.00">

            <label for="total">Valor Total (R$ - opcional se calculado pelo sistema):</label>
            <input type="number" step="0.01" id="total" name="total" value="0.00">

            <label for="pagamento">Forma de Pagamento:</label>
            <input type="text" id="pagamento" name="pagamento">
        </fieldset>

        <div class="botao">
            <button type="submit">💾 Salvar Prestação de Serviço</button>
        </div>

    </form>

    <?php if ($exibir_recibo): ?>
        <div class='resumo-card'>
            <h2 class='resumo-header'>📋 Comprovante de Prestação de Serviço</h2>
            <div class='resumo-body'>
                <div class='grid-dados'>
                    <div class='secao-dados'>
                        <h3>Prestador</h3>
                        <p><strong>Nome:</strong> <?php echo $dados['prestador']; ?></p>
                        <p><strong>Doc:</strong> <?php echo $dados['documento']; ?></p>
                        <p><strong>Tel:</strong> <?php echo $dados['telefone']; ?></p>
                        <p><strong>E-mail:</strong> <?php echo $dados['email']; ?></p>
                    </div>
                    
                    <div class='secao-dados'>
                        <h3>Cliente & Agendamento</h3>
                        <p><strong>Nome:</strong> <?php echo $dados['cliente']; ?></p>
                        <p><strong>Endereço:</strong> <?php echo $dados['endereco']; ?></p>
                        <p><strong>Tel:</strong> <?php echo $dados['telefone_cli']; ?></p>
                        <p><strong>Data:</strong> <?php echo $dados['data_formatada']; ?> às <?php echo $dados['horario_formatado']; ?></p>
                    </div>
                </div>

                <div class='lista-servicos'>
                    <h3>Serviços Realizados</h3>
                    <?php if (!empty($dados['servicos'])): ?>
                        <ul>
                            <?php foreach ($dados['servicos'] as $servico): ?>
                                <li>✔️ <?php echo htmlspecialchars($servico); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>Nenhum serviço selecionado.</p>
                    <?php endif; ?>
                </div>

                <?php if (!empty($dados['observacoes'])): ?>
                    <div class='observacao-box'>
                        <h3>Observações</h3>
                        <p><?php echo nl2br($dados['observacoes']); ?></p>
                    </div>
                <?php endif; ?>

                <table class='tabela-valores'>
                    <tr><td>Valor do Serviço:</td><td class='text-right'>R$ <?php echo number_format($dados['valor_servico'], 2, ',', '.'); ?></td></tr>
                    <tr><td>Produtos Utilizados:</td><td class='text-right'>R$ <?php echo number_format($dados['produtos'], 2, ',', '.'); ?></td></tr>
                    <tr><td>Desconto:</td><td class='text-right'>- R$ <?php echo number_format($dados['desconto'], 2, ',', '.'); ?></td></tr>
                    <tr><td>Forma de Pagamento:</td><td class='text-right'><?php echo $dados['pagamento']; ?></td></tr>
                    <tr class='total-row'><td>Valor Total:</td><td class='text-right'>R$ <?php echo number_format($dados['total_final'], 2, ',', '.'); ?></td></tr>
                </table>
            </div>
        </div>
    <?php endif; ?>

</div> 
</body>
</html>