<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #ef6f82;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            margin-top: 5%;
            margin-left: 30%;
            display: block;
            width: 50%;
            padding: 10px;
            font-size: 16px;
            background-color: #ef6f82;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: pink;
        }
    </style>
    <script>
        function consultarCep(event) {
            event.preventDefault();
            
            var cepInput = document.getElementById("cep");
            var cepValue = cepInput.value;
            
            if (cepValue.trim() != "") {
                var xhttp = new XMLHttpRequest();
                var url = "https://viacep.com.br/ws/" + cepValue + "/json/";
                
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        
                        if (response.hasOwnProperty("erro")) {
                            exibirMensagem("CEP não encontrado.");
                        } else {
                            var resultado = document.getElementById("resultado");
                            resultado.innerHTML = "<h2>Resultado da consulta:</h2>" +
                                "<p><strong>CEP:</strong> " + response.cep + "</p>" +
                                "<p><strong>Logradouro:</strong> " + response.logradouro + "</p>" +
                                "<p><strong>Bairro:</strong> " + response.bairro + "</p>" +
                                "<p><strong>Cidade:</strong> " + response.localidade + "</p>" +
                                "<p><strong>Estado:</strong> " + response.uf + "</p>";
                        }
                    }
                };
                xhttp.open("GET", url, true);
                xhttp.send();
            } else {
                exibirMensagem("Por favor, digite um CEP válido.");
            }
        }
        
        function exibirMensagem(mensagem) {
            var resultado = document.getElementById("resultado");
            resultado.innerHTML = "<p>" + mensagem + "</p>";
        }
    </script>
    <title>Document</title>
</head>
<body>
    <h1>Consulta de CEP</h1>
    <form action="ConsultaCep.php" method="POST">
        <label for="cep">Digite o CEP:</label>
        <input type="text" id="cep" name="cep" required>
        <button type="submit">Consultar</button>
    </form>
    <div id="resultado"></div>
</body>
</html>


