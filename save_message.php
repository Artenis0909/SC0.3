<?php
// Função para limpar e validar a mensagem recebida
function limparMensagem($mensagem) {
    $mensagem = strip_tags($mensagem); // Remove tags HTML
    $mensagem = htmlspecialchars($mensagem); // Converte caracteres especiais para HTML
    $mensagem = trim($mensagem); // Remove espaços em branco no início e fim
    return $mensagem;
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura a mensagem e o nome temporário
    $nome = limparMensagem($_POST['nome']);
    $mensagem = limparMensagem($_POST['mensagem']);

    // Verifica se a mensagem e o nome não estão vazios
    if (!empty($mensagem) && !empty($nome)) {
        // Formata a mensagem
        $mensagemCompleta = "<strong>" . $nome . ":</strong> " . $mensagem . "\n";
        
        // Salva a mensagem em um arquivo de texto
        file_put_contents('messages.txt', $mensagemCompleta, FILE_APPEND);
    }
}

// Função para exibir mensagens
function exibirMensagens() {
    if (file_exists('messages.txt')) {
        $mensagens = file_get_contents('messages.txt');
        echo nl2br($mensagens); // Converte quebras de linha para <br> para exibir corretamente no HTML
    }
}
?>
