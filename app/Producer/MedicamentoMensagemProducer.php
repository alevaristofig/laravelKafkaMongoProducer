<?php declare(strict_types=1);

    namespace App\Producer;

    use Illuminate\Database\Eloquent\Collection;
    use Junges\Kafka\Facades\Kafka;
    use Junges\Kafka\Message\Message;

    class MedicamentoMensagemProducer {

        public function produzirMensagem(Collection $dados): void {

            try {
                $message = new Message(
                    body: [
                        'nome' => $dados[0]->nome, 
                        'preco' => $dados[0]->preco, 
                        'quantidade' => $dados[0]->quantidade,
                        'manipulado' => $dados[0]->manipulado
                    ],
                    key: $dados[0]->id
                );

                $producer = Kafka::publish('localhost:9092')
                    ->onTopic('medicamentos')
                    ->withConfigOptions([
                        'compression.codec' => 'none'
                    ])
                    ->withDebugEnabled()
                    ->withMessage($message);  
                    
                $producer->send();
                
            } catch(Exception $e) {
                dd(e->getMessage());
            }
        }
    }