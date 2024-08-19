<?php
// Função para limpar e validar a mensagem recebida
function limparMensagem($mensagem) {
    return htmlspecialchars(trim($mensagem));
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura a mensagem e o nome temporário
    $nome = limparMensagem($_POST['nome']);
    $mensagem = limparMensagem($_POST['mensagem']);

    // Verifica se a mensagem e o nome não estão vazios
    if (!empty($mensagem) && !empty($nome)) {
        // Formata a mensagem com o nome em negrito
        $mensagemCompleta = "<p><strong>" . $nome . ":</strong> " . $mensagem . "</p>\n";
        
        // Salva a mensagem em um arquivo de texto
        file_put_contents('messages.txt', $mensagemCompleta, FILE_APPEND);
    }
}

// Função para exibir mensagens
function exibirMensagens() {
    if (file_exists('messages.txt')) {
        $mensagens = file_get_contents('messages.txt');
        echo $mensagens;
    }
}
?>
