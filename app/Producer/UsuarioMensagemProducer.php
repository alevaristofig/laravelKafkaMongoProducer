<?php declare(strict_types=1);

    namespace App\Producer;

    use Illuminate\Database\Eloquent\Collection;
    use Junges\Kafka\Facades\Kafka;
    use Junges\Kafka\Message\Message;

    class UsuarioMensagemProducer {

        public function produzirMensagem(Collection $dados): void {

            try {
                $message = new Message(
                    body: ['nome' => $dados[0]->nome, 'email' => $dados[0]->email, 'senha' => $dados[0]->senha],
                    key: $dados[0]->id
                );

                $producer = Kafka::publish('localhost:9092')
                    ->onTopic('usuarios')
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