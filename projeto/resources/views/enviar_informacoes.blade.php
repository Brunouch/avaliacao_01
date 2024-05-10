<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Informações</title>
</head>
<body>
    <form action="{{ route('calcular') }}" method="post">
        @csrf
        <label for="galao_volume">Insira o volume do galão:</label>
        <input type="text" name="galao_volume" id="galao_volume"><br><br>

        <label for="quantidade_garrafas">Quantidade de garrafas:</label>
        <input type="number" name="quantidade_garrafas" id="quantidade_garrafas"><br><br>

        <div id="garrafas">
            <!-- Aqui serão adicionados os campos das garrafas dinamicamente -->
        </div>

        <button type="submit">Calcular</button>
    </form>

    <script>
        document.getElementById('quantidade_garrafas').addEventListener('input', function() {
            const quantidadeGarrafas = parseInt(this.value);
            const garrafasDiv = document.getElementById('garrafas');
            garrafasDiv.innerHTML = '';

            for (let i = 1; i <= quantidadeGarrafas; i++) {
                const label = document.createElement('label');
                label.innerHTML = `Garrafa ${i}: `;
                garrafasDiv.appendChild(label);

                const input = document.createElement('input');
                input.type = 'text';
                input.name = `garrafas[]`;
                garrafasDiv.appendChild(input);

                const lineBreak = document.createElement('br');
                garrafasDiv.appendChild(lineBreak);
            }
        });
    </script>
</body>
</html>