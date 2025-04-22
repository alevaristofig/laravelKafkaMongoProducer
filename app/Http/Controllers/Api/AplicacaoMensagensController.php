<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AplicacaoMensagensRequest;
use App\Models\Aplicacao;
use Illuminate\Http\JsonResponse;

class AplicacaoMensagensController extends Controller
{
    private $model;

    public function __construct(Aplicacao $aplicacao) {
        $this->model = $aplicacao;
    }

    public function index(): JsonResponse {
        $dados = $this->model->select()->get();

        return response()->json($dados,200);
    }

    public function adicionar(AplicacaoMensagensRequest $request): JsonResponse {
        $dados = $request->all();

        $this->model->paciente = $dados['paciente'];
        $this->model->medicamento = $dados['medicamento'];
        $this->model->dataAplicacao = $dados['dataAplicacao'];

        $this->model->save();

        return response()->json($dados,200);
    }
}
