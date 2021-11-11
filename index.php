<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- View -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">

    <!-- Javascript -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>

    <title>Aula 19/10</title>
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

    <table id="example" class="table" style="width:100%">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Idade</th>
                <th>Telefone</th>
                <th>Data Nasc</th>
                <th>CPF</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Giovana Beatriz</td>
                <td>Silveira</td>
                <td>19</td>
                <td>99688874</td>
                <td>25/07/2002</td>
                <td>1996584221</td>
            </tr>
            <tr>
                <td>Júlia</td>
                <td>Marcondes</td>
                <td>20</td>
                <td>874521000</td>
                <td>12/08/2001</td>
                <td></td>
            </tr>
            <br>

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
                        bootbox.alert("Informe seu cep");
                    }
                });

                $("#btnEnviar").click(function() {
                    $.post("cadastrar.php", {
                            nome: $("#nome").val(),
                            cep: $("#cep").val(),
                            cidade: $("#cidade").val(),
                            uf: $("#uf").val(),
                        },
                        function(data) {
                            if (data.resp == false) {
                                bootbox.alert(`Ocorreu um erro:"${data.msg}"`);
                            } else {
                                bootbox.confirm("Deseja acessar esse site?",
                                    function(escolha) {
                                        if (escolha == true) {
                                            location.href = "https://www.google.com.br/";
                                        } else {
                                            bootbox.alert("Beleza!!!");
                                        }
                                    });
                            }
                        },

                        "JSON")
                });

                $(document).ready(function() {
                    $('#example').DataTable({
                       language: {
                           "paginate": {
                            "next": "Próximo",
                            "previous": "Anterior",
                            "first": "Primeiro",
                            "last": "Último"
                            },
                            "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                            "infoEmpty": "Mostrando 0 até 0 de 0 registros",
                            "search": "Pesquisar",
                            "lengthMenu": "Exibir _MENU_ resultados"
                       },
                       dom: 'Bfrtip',
                        buttons: [
                            'copy',
                            'excel',
                            'csv',
                            'pdf',
                            'print'
                        ]
                    });
                });
            </script>

</body>

</html>