<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestação de Serviço - Limpeza de Piscina</title>

    <style>
        /* =========================================
           ESTILOS DO BODY E DO FORMULÁRIO PRINCIPAL
           ========================================= */
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 50%, #7dd3fc 100%);
            background-attachment: fixed;
            margin: 0;
            padding: 20px;
            color: #334155;
        }

        .container {
            max-width: 800px;
            margin: 30px auto;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 99, 204, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.8);
        }

        h1 {
            text-align: center;
            color: #0369a1;
            margin-bottom: 30px;
            font-size: 28px;
        }

        fieldset {
            margin-bottom: 25px;
            padding: 20px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            background-color: #f8fafc;
        }

        legend {
            font-weight: bold;
            color: #0284c7;
            padding: 0 10px;
            font-size: 18px;
        }

        label {
            display: block;
            margin-top: 12px;
            font-weight: 600;
            color: #475569;
        }

        input[type=text],
        input[type=email],
        input[type=date],
        input[type=time],
        input[type=number],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            padding: 8px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            cursor: pointer;
        }

        .checkbox input {
            margin: 0;
            cursor: pointer;
        }

        .botao {
            text-align: center;
            margin-top: 25px;
        }

        button {
            background: #0284c7;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.2s, transform 0.1s;
            box-shadow: 0 4px 6px rgba(2, 132, 199, 0.2);
        }

        button:hover {
            background: #0369a1;
        }

        button:active {
            transform: scale(0.98);
        }

        /* =========================================
           ESTILOS DO RECIBO / RESUMO (PHP)
           ========================================= */
        .resumo-card {
            margin-top: 40px;
            background: #ffffff;
            border: 2px solid #0284c7;
            border-radius: 12px;
            box-shadow: 0 15px 30px rgba(2, 132, 199, 0.1);
            overflow: hidden;
        }
        
        .resumo-header {
            background: #0284c7;
            color: #ffffff;
            padding: 15px 20px;
            text-align: center;
            margin: 0;
            font-size: 20px;
            letter-spacing: 0.5px;
        }
        
        .resumo-body {
            padding: 25px;
        }
        
        .grid-dados {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }
        
        @media (max-width: 600px) {
            .grid-dados {
                grid-template-columns: 1fr; /* Responsivo para celular */
            }
        }

        .secao-dados {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
        
        .secao-dados h3 {
            margin-top: 0;
            margin-bottom: 10px;
            color: #0369a1;
            font-size: 15px;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .secao-dados p {
            margin: 6px 0;
            font-size: 14px;
            color: #334155;
        }
        
        .lista-servicos {
            background: #f0fdfa;
            border: 1px solid #ccfbf1;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        
        .lista-servicos h3 {
            margin-top: 0;
            color: #0d9488;
            font-size: 15px;
            border-bottom: 2px solid #ccfbf1;
            padding-bottom: 5px;
        }
        
        .lista-servicos ul {
            margin: 8px 0 0 0;
            padding-left: 20px;
            color: #115e59;
        }
        
        .lista-servicos li {
            margin-bottom: 4px;
            font-size: 14px;
        }
        
        .observacao-box {
            background: #fffbeb;
            border: 1px solid #fef3c7;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            color: #92400e;
            font-size: 14px;
        }
        
        .observacao-box h3 {
            margin-top: 0;
            color: #b45309;
            font-size: 15px;
        }
        
        .tabela-valores {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        
        .tabela-valores td {
            padding: 8px 0;
            font-size: 14px;
            color: #475569;
        }
        
        .tabela-valores tr.total-row td {
            padding-top: 15px;
            border-top: 2px dashed #cbd5e1;
            font-size: 18px;
            font-weight: bold;
            color: #0284c7;
        }
        
        .text-right {
            text-align: right;
        }
    </style>

</head>
<body>

<div class="container">

    <h1>🏊 Prestação de Serviço - Limpeza de Piscina</h1>

    <form action="" method="post">

        <fieldset>
            <legend>Dados do Prestador</legend>

            <label for="prestador">Nome:</label>
            <input type="text" id="prestador" name="prestador">

            <label for="documento">CPF/CNPJ:</label>
            <input type="text" id="documento" name="documento">

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email">
        </fieldset>

        <fieldset>
            <legend>Dados do Cliente</legend>

            <label for="cliente">Nome:</label>
            <input type="text" id="cliente" name="cliente">

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco">

            <label for="telefone_cliente">Telefone:</label>
            <input type="text" id="telefone_cliente" name="telefone_cliente">

            <label for="data">Data:</label>
            <input type="date" id="data" name="data">

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
            <input type="number" step="0.01" id="valor_servico" name="valor_servico">

            <label for="produtos">Produtos Utilizados (R$):</label>
            <input type="number" step="0.01" id="produtos" name="produtos">

            <label for="desconto">Desconto (R$):</label>
            <input type="number" step="0.01" id="desconto" name="desconto">

            <label for="total">Valor Total (R$):</label>
            <input type="number" step="0.01" id="total" name="total">

            <label for="pagamento">Forma de Pagamento:</label>
            <input type="text" id="pagamento" name="pagamento">
        </fieldset>

        <div class="botao">
            <button type="submit">
                💾 Salvar Prestação de Serviço
            </button>
        </div>

    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Tratamento de variáveis com coalescência nula
        $prestador     = $_POST["prestador"] ?? '';
        $documento     = $_POST["documento"] ?? '';
        $telefone      = $_POST["telefone"] ?? '';
        $email         = $_POST["email"] ?? '';
        
        $cliente       = $_POST["cliente"] ?? '';
        $endereco      = $_POST["endereco"] ?? '';
        $telefone_cli  = $_POST["telefone_cliente"] ?? '';
        $data          = $_POST["data"] ?? '';
        $horario       = $_POST["horario"] ?? '';
        
        $observacoes   = $_POST["observacoes"] ?? '';
        $valor_servico = $_POST["valor_servico"] ?? 0;
        $produtos      = $_POST["produtos"] ?? 0;
        $desconto      = $_POST["desconto"] ?? 0;
        $total         = $_POST["total"] ?? 0;
        $pagamento     = $_POST["pagamento"] ?? '';

        // Formatação da data para o padrão brasileiro
        $data_formatada = !empty($data) ? date('d/m/Y', strtotime($data)) : '---';

        echo "<div class='resumo-card'>";
        echo "  <h2 class='resumo-header'>📋 Comprovante de Prestação de Serviço</h2>";
        echo "  <div class='resumo-body'>";

        // Grid com dados do Prestador e Cliente
        echo "      <div class='grid-dados'>";
        echo "          <div class='secao-dados'>";
        echo "              <h3>Prestador</h3>";
        echo "              <p><strong>Nome:</strong> " . htmlspecialchars($prestador) . "</p>";
        echo "              <p><strong>Doc:</strong> " . htmlspecialchars($documento) . "</p>";
        echo "              <p><strong>Tel:</strong> " . htmlspecialchars($telefone) . "</p>";
        echo "              <p><strong>E-mail:</strong> " . htmlspecialchars($email) . "</p>";
        echo "          </div>";
        
        echo "          <div class='secao-dados'>";
        echo "              <h3>Cliente & Agendamento</h3>";
        echo "              <p><strong>Nome:</strong> " . htmlspecialchars($cliente) . "</p>";
        echo "              <p><strong>Endereço:</strong> " . htmlspecialchars($endereco) . "</p>";
        echo "              <p><strong>Tel:</strong> " . htmlspecialchars($telefone_cli) . "</p>";
        echo "              <p><strong>Data:</strong> " . $data_formatada . " às