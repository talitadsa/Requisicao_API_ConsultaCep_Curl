<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (isset($_POST['cep']) && !empty($_POST['cep'])) {
      
        $cep = $_POST['cep'];
        $curl = curl_init();
        $url = "https://viacep.com.br/ws/" . $cep . "/json/";
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);

        if (isset($data['erro'])) {
            echo "CEP não encontrado.";
        } else {
            echo "<h2>Resultado da consulta:</h2>";
            echo "<p><strong>CEP:</strong> " . $data['cep'] . "</p>";
            echo "<p><strong>Logradouro:</strong> " . $data['logradouro'] . "</p>";
            echo "<p><strong>Bairro:</strong> " . $data['bairro'] . "</p>";
            echo "<p><strong>Cidade:</strong> " . $data['localidade'] . "</p>";
            echo "<p><strong>Estado:</strong> " . $data['uf'] . "</p>";
        }
    } else {
        echo "Por favor, digite um CEP válido.";
    }
}
?>
