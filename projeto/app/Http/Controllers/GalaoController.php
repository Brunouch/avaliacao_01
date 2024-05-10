<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalaoController extends Controller
{
    public function index()
    {
        return view('enviar_informacoes');
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'galao_volume' => 'required|numeric',
            'garrafas.*' => 'required|numeric|min:0',
        ]);

        $galaoVolume = $request->galao_volume;
        $garrafas = $request->garrafas;

        // Ordenando garrafas em ordem decrescente
        rsort($garrafas);

        // Inicializando variáveis
        $garrafasEscolhidas = [];
        $sobraGalao = $galaoVolume;

        // Escolhendo as garrafas
        foreach ($garrafas as $garrafa) {
            if ($sobraGalao >= $garrafa) {
                $garrafasEscolhidas[] = $garrafa;
                $sobraGalao -= $garrafa;
            }
        }

        return view('resultados', compact('garrafasEscolhidas', 'sobraGalao'));
    }
}
