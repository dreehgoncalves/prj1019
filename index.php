<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <title>Aula 19/10</title>
    <style>
        .cep {
            display: none;
        }
    </style>
</head>

<body>

    <p>Nome</p>
    <input type="text" id="nome" class="form-control">
    <p>CEP</p>
    <input type="text" id="cep" class="form-control col-3">
    <p class="cep">Cidade</p>
    <input type="text" id="cidade" class="form-control cep">
    <p class="cep">UF</p>
    <select id="uf" class="form-control cep">
        <option value="AC">Acre</option>
        <option value="AL">Alagoas</option>
        <option value="AP">Amapá</option>
        <option value="AM">Amazonas</option>
        <option value="BA">Bahia</option>
        <option value="CE">Ceará</option>
        <option value="DF">Distrito Federal</option>
        <option value="ES">Espírito Santo</option>
        <option value="GO">Goiás</option>
        <option value="MA">Maranhão</option>
        <option value="MT">Mato Grosso</option>
        <option value="MS">Mato Grosso do Sul</option>
        <option value="MG">Minas Gerais</option>
        <option value="PA">Pará</option>
        <option value="PB">Paraíba</option>
        <option value="PR">Paraná</option>
        <option value="PE">Pernambuco</option>
        <option value="PI">Piauí</option>
        <option value="RJ">Rio de Janeiro</option>
        <option value="RN">Rio Grande do Norte</option>
        <option value="RS">Rio Grande do Sul</option>
        <option value="RO">Rondônia</option>
        <option value="RR">Roraima</option>
        <option value="SC">Santa Catarina</option>
        <option value="SP">São Paulo</option>
        <option value="SE">Sergipe</option>
        <option value="TO">Tocantins</option>
    </select>
    <br>
    <button type="button" id="btnEnviar" class="btn btn-outline-dark">Enviar</button>

    <script>
        $("#cep").focusout(function() {
            let cep = $("#cep").val();
            if (cep != "") {
                $.get('https://viacep.com.br/ws/' + cep + '/json/',
                    function(data) {
                        $(".cep").show();
                        $("#cidade").val(data.localidade);
                        $("#uf").val(data.uf);
                    },
                    "JSON");
            } else {
                alert("Informe seu cep");
            }
        });

        $("#btnEnviar").click(function() {
            $.post("cadastrar.php", {
                    nome: $("nome").val(),
                    cep: $("cep").val(),
                    cidade: $("cidade").val(),
                    uf: $("uf").val(),
                },
                function(data) {
                    if (data.resp == false) {
                        window.alert(`Ocorreu um erro:"${data.msg}"`);
                    } else {
                        window.alert(data.msg);
                        location.reload();
                    }
                },
                "JSON")
        });
    </script>

</body>

</html>