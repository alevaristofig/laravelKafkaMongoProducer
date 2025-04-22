<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MedicamentoMensagensRequest;
use App\Models\Medicamento;
use Illuminate\Http\JsonResponse;

class MedicamentoMensagensController extends Controller
{
    private $model;

    public function __construct(Medicamento $model) {
        $this->model = $model;
    }

    public function index(): JsonResponse {
        $dados = $this->model->select()->get();

        return response()->json($dados,200);
    }

    public function adicionar(MedicamentoMensagensRequest $request): JsonResponse {
        $dados = $request->all();

        $this->model->nome = $dados['nome'];
        $this->model->preco = $dados['preco'];
        $this->model->quantidade = $dados['quantidade'];
        $this->model->manipulado = $dados['manipulado'];        

        $this->model->save();
        
        return response()->json($dados,200);
    }
}
