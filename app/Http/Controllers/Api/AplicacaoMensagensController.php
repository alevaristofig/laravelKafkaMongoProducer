<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AplicacaoMensagensRequest;
use App\Models\Aplicacao;
use App\Producer\AplicacaoMensagemProducer;
use Illuminate\Http\JsonResponse;

class AplicacaoMensagensController extends Controller
{
    private $model;
    private $producer;

    public function __construct(Aplicacao $aplicacao, AplicacaoMensagemProducer $producer) {
        $this->model = $aplicacao;
        $this->producer = $producer;
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

    public function produzirMensagens(string $id): JsonResponse {

        $dados = $this->model->where('id',$id)->get();

        $this->producer->produzirMensagem($dados);

        return response()->json(['ok' => true, 'mensagem' => "Mensagem produzida com sucesso"],200);
    }
}
