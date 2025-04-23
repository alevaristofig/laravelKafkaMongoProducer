<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsuarioMensagensRequest;
use App\Models\Usuario;
use App\Producer\UsuarioMensagemProducer;
use Illuminate\Http\JsonResponse;

class UsuarioMensagensController extends Controller
{
    private $model;
    private $producer;

    public function __construct(Usuario $model, UsuarioMensagemProducer $producer) {
        $this->model = $model;
        $this->producer = $producer;
    }

    public function index(): JsonResponse {
        $dados = $this->model->select()->get();

        return response()->json($dados,200);
    }

    public function adicionar(UsuarioMensagensRequest $request): JsonResponse {
        $dados = $request->all();

        $this->model->nome = $dados['nome'];
        $this->model->email = $dados['email'];
        $this->model->senha = $dados['senha'];

        $this->model->save();
        
        return response()->json($dados,200);
    }

    public function produzirMensagens(string $id): JsonResponse {

        $dados = $this->model->where('id',$id)->get();

        $this->producer->produzirMensagem($dados);

        return response()->json(['ok' => true, 'mensagem' => "Mensagem produzida com sucesso"],200);
    }
}
