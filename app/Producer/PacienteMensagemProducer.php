<?php declare(strict_types=1);

    namespace App\Producer;

    use Illuminate\Database\Eloquent\Collection;
    use Junges\Kafka\Facades\Kafka;
    use Junges\Kafka\Message\Message;

    class PacienteMensagemProducer {

        public function produzirMensagem(Collection $dados): void {

            try {
                $message = new Message(
                    body: [
                            'nome' => $dados[0]->nome, 
                            'raca' => $dados[0]->raca, 
                            'peso' => $dados[0]->peso,
                            'cor'  => $dados[0]->cor,
                            'idade' => $dados[0]->idade,
                            'usuario' => ['id' => $dados[0]->usuario['id'] ]
                
                         ],                  
                    key: $dados[0]->id
                );

                $producer = Kafka::publish('localhost:9092')
                    ->onTopic('pacientes')
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