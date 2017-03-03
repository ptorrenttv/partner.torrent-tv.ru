#### Пример использования

```php
<?php

require('vendor/autoload.php');

use GuzzleHttp\Exception\TransferException;
use TorrentTv\PartnerApi\ApiException;
use TorrentTv\PartnerApi\PartnerApi;

$api = new PartnerApi('{YOUR_USERNAME}', '{YOUR_KEY}');
try {
    $usersInfo = $api->getAllUsersInfo();
    print_r($usersInfo);
} catch (TransferException $e) {
    if ($e instanceof ApiException) {
        $errorCode = $e->getErrorCode();
        // incorrect - подпись не верна
        // no_connect - ошибка соединения с БД
        // no_param - ошибка входных параметров
    }
}
```

Подробная документация на http://partner.torrent-tv.ru/api.php
