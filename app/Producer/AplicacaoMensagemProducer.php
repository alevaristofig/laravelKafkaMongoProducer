<?php declare(strict_types=1);

    namespace App\Producer;

    use Illuminate\Database\Eloquent\Collection;
    use Junges\Kafka\Facades\Kafka;
    use Junges\Kafka\Message\Message;

    class AplicacaoMensagemProducer {

        public function produzirMensagem(Collection $dados): void {

            try {
                $message = new Message(
                    body: [
                            'paciente' => ['id' => $dados[0]->paciente['id']],
                            'medicamento' => ['id' => $dados[0]->medicamento['id']],
                            'dataAplicacao' => $dados[0]->dataAplicacao,                                            
                         ],                  
                    key: $dados[0]->id
                );

                $producer = Kafka::publish('localhost:9092')
                    ->onTopic('aplicacao')
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