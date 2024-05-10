<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
    <h1>Encher Garrafas</h1>
    <form method="POST" action="{{url ('encher')}}" id="formEncher" > 
        @csrf
        <label for="galaoVolume">Volume do Galão:</label>
        <input type="number" id="galaoVolume" name="galao_volume" required>
        <br><br>
        <label for="quantidadeGarrafas">Quantidade de Garrafas:</label>
        <input type="number" id="quantidadeGarrafas" name="garrafas[]" required>
        <br><br>
        <div id="garrafasInputs"></div>
        <br>
        <button type="submit">Encher Garrafas</button>
    </form>

    <div id="resultado"></div>

    <script>
        document.getElementById('formEncher').addEventListener('submit', function(event) {
            event.preventDefault();

            const galaoVolume = document.getElementById('galaoVolume').value;
            const quantidadeGarrafas = document.getElementById('quantidadeGarrafas').value;
            const garrafasInputs = document.querySelectorAll('.garrafaInput');
            const garrafas = [];

            garrafasInputs.forEach(function(input) {
                garrafas.push(input.value);
            });

            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

            fetch('{{ url("encher") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    galao_volume: galaoVolume,
                    garrafas: garrafas
                })
            })
            .then(response => response.json())
            .then(data => {
                const resultadoDiv = document.getElementById('resultado');
                resultadoDiv.innerHTML = '<pre>' + JSON.stringify(data, null, 2) + '</pre>';
                resultadoDiv.style.display = 'block'; // Mostrar o resultado na página
            })
            .catch(error => console.error('Erro:', error));
        });

        document.getElementById('quantidadeGarrafas').addEventListener('change', function() {
            const quantidadeGarrafas = parseInt(this.value);
            const garrafasInputs = document.getElementById('garrafasInputs');
            garrafasInputs.innerHTML = '';

            for (let i = 0; i < quantidadeGarrafas; i++) {
                const input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('class', 'garrafaInput');
                input.setAttribute('placeholder', 'Volume da Garrafa ' + (i + 1));
                input.setAttribute('required', true);
                garrafasInputs.appendChild(input);
                garrafasInputs.appendChild(document.createElement('br'));
            }
        });
    </script>
</body>
</html>
