<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    public function getCepData($cep)
    {
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed()) {
            return response()->json([
                'error' => 'Não foi possível buscar o CEP.'
            ], 400);
        }

        $data = $response->json();
        if (isset($data['erro']) && ($data['erro'] === true || $data['erro'] === "true")) {
            return response()->json([
                'error' => 'CEP não encontrado ou inválido.'
            ], 404);
        }

        return response()->json($data, 200);
    }
}
