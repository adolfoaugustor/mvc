#Configurando o email
---
Criando uma pasta em modules/SEU_MODULO/src/Services/Mail  e adicone suas configurações de email

Exemplo:

```php

<?php
    
    namespace Rtd\SEU_MODULO\Services\Mail;
    
    use Sistema\Mail\MailMessage;
    
    class AlertaCartorioMail extends MailMessage
          {
              public function configurar()
              {
                  $this
                      ->template('email/alerta_cartorio.html')
                      ->de('suporte@rtdbrasil.org.br')
                      ->assunto('Alerta')
                      ->anexar('/home/edno/pdfs/inteiro_teor_sem_averbacoes.pdf')
                      ->dados([
                          'cartorio'               => '1º Ofício de Fortaleza',
                          'oficial'                => 'Francisco Edno',
                          'qtdCustas'              => 5,
                          'qtdDocumento'           => 3,
                          'qtdNotificacao'         => 6,
                          'qtdCertidaoNotificacao' => 1,
                          'qtdBusca'               => 0,
                          'qtdCertidao'            => 2
                      ])
                  ;
              }
              
          }  
          
```

##Enviando o Email
--
É necessário passar as configurações criadas anteriormente para a aclass email no metodo enviar, passando seu destinatário.

Exemplo:

```
    <?php
    
      Email::para($destinatario)->enviar(new AlertaCartorioEmail($dados);
        
    ?>    
    
```
