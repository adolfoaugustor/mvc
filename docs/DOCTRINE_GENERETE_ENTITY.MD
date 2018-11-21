# Comandos Doctrine

### Gerando engenharia reversa do banco de dados.
```php
source .env - Carregando configurações de variaveis de ambiente
$this->paths = realpath('/tmp'); - Localização da geração das entidades 
$config->setFilterSchemaAssetsExpression('/financeiro\.+/'); - Schema à ser gerado
doctrine orm:convert-mapping --namespace="Rtd\\Financeiro\\Entity\\" --force --from-database annotation /tmp - Executando mapeamento das entidades
Executar o script Shell
```

### Gerando mapeamento e relacionamento das entidades.

```
$this->paths = realpath('/tmp/Rtd/Financeiro/Entity'); - Local onde as entidades foram geradas anteriormente.
./vendor/bin/doctrine orm:generate-entities --generate-annotations=true /tmp/novo/
mv * ~/apps/nova-central-struct/module/Financeiro/Entity/
```

