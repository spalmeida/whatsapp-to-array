
# Whatsapp to Array
Filtra o arquivo de texto exportado do whatsapp para um array ou json com data, nome do usuário e o texto da conversa.

### INICIANDO
```php
    $whats = new Whatsapp;
    echo '<pre>';
    print_r($whats->filterChat('MEU_ARQUIVO.txt'));
    echo '</pre>';
```
### RETORNO
    [0] => Array
        (
            [date] => 06/01/20 10:40
            [from] => Samuel
            [text] =>  bom dia 
        )

    [1] => Array
        (
            [date] => 06/01/20 10:41
            [from] => Teste
            [text] =>  Bom dia 
        )

    [2] => Array
        (
            [date] => 06/01/20 10:42
            [from] => Samuel
            [text] =>  Tudo bem? 
        )

    [3] => Array
        (
            [date] => 06/01/20 10:42
            [from] => Teste
            [text] =>  tudo sim ! 
        )

