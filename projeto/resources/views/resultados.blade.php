<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
</head>
<body>
    <h2>Resposta:</h2>
    <p>Garrafas Escolhidas: [{{ implode('L, ', $garrafasEscolhidas) }}L]</p>
    <p>Sobra no Galão: {{ number_format($sobraGalao, 1) }}L</p>

    <!--<form action="{{ route('enviar_informacoes') }}">
        <button type="submit">Home</button>
    </form>-->
</body>
</html>