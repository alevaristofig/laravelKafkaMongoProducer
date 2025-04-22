<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PacienteMensagensControllerRequest;
use App\Models\Paciente;
use Illuminate\Http\JsonResponse;

class PacienteMensagensController extends Controller
{
    private $model;

    public function __construct(Paciente $model) {
        $this->model = $model;
    }

    public function index(): JsonResponse {
        $dados = $this->model->select()->get();

        return response()->json($dados,200);
    }

    public function adicionar(PacienteMensagensControllerRequest $request): JsonResponse {
        $dados = $request->all();

        $this->model->nome = $dados['nome'];
        $this->model->raca = $dados['raca'];
        $this->model->peso = $dados['peso'];
        $this->model->cor = $dados['cor'];
        $this->model->idade = $dados['idade'];
        $this->model->usuario = $dados['usuario'];

        $this->model->save();
        
        return response()->json($dados,200);
    }
}
