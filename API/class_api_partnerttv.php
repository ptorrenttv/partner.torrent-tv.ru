<?php

class ApiPartnerTTV
{
    private $key = '';                            // Ваш KEY для API
    private $username = '';                       // Ваш USERNAME для API
    private $url = 'partner.torrent-tv.ru/api';

    public function AddUser($user, $notes)  // Регистрация пользователя
    {

        $hash = strtolower(md5($this->username . '.' . $this->key . '.' . $user));
        $note = rawurlencode($notes);
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Accept-Language: ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip,deflate,sdch';
        $headers[] = 'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.3';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://' . $this->url . '/user_add.php?' .
            'user=' . $user .
            '&notes=' . $note .
            '&USERNAME=' . $this->username .
            '&hash=' . $hash .
            '&typeresult=' . 'json'
        );
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function DelUser($user)  // Удаление пользователя
    {
        $hash = strtolower(md5($this->username . '.' . $this->key . '.' . $user));
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Accept-Language: ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip,deflate,sdch';
        $headers[] = 'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.3';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://' . $this->url . '/user_del.php?' .
            'user=' . $user .
            '&USERNAME=' . $this->username .
            '&hash=' . $hash .
            '&typeresult=' . 'json'
        );
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function InfoUser($user) // Получить информацию по пользователю
    {
        $hash = strtolower(md5($this->username . '.' . $this->key . '.' . $user));
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Accept-Language: ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip,deflate,sdch';
        $headers[] = 'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.3';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://' . $this->url . '/user_info.php?' .
            'user=' . $user .
            '&USERNAME=' . $this->username .
            '&hash=' . $hash .
            '&typeresult=' . 'xml'
        );
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function InfoAllUser($user, $all) // Получить информацию по всем пользователям
    {
        $hash = strtolower(md5($this->username . '.' . $this->key . '.' . $user));
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Accept-Language: ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip,deflate,sdch';
        $headers[] = 'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.3';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://' . $this->url . '/user_info.php?' .
            'user=' . $user .
            '&all=' . $all .
            '&USERNAME=' . $this->username .
            '&hash=' . $hash .
            '&typeresult=' . 'json'
        );
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function SetTokenUser($user) // Сменить ссылку на плейлист для клиента
    {
        $hash = strtolower(md5($this->username . '.' . $this->key . '.' . $user));
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Accept-Language: ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip,deflate,sdch';
        $headers[] = 'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.3';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://' . $this->url . '/user_set_token.php?' .
            'user=' . $user .
            '&USERNAME=' . $this->username .
            '&hash=' . $hash .
            '&typeresult=' . 'json'
        );
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function SubscriptionManagment($user, $period)  // Подключение/продление подписки
    {
        $hash = strtolower(md5($this->username . '.' . $this->key . '.' . $user . '.' . $period));
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Accept-Language: ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip,deflate,sdch';
        $headers[] = 'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.3';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://' . $this->url . '/subscription_managment.php?' .
            'user=' . $user .
            '&period=' . $period .
            '&USERNAME=' . $this->username .
            '&hash=' . $hash .
            '&typeresult=' . 'json'
        );
        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function UserParamPlaylist($user, $ts, $tag, $epg, $cat, $hls, $cat_group, $format) // Сменить тип плейлиста, кодировку, формат плейлиста для клиента
    {
        $hash = strtolower(md5($this->username . '.' . $this->key . '.' . $user));
        $headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
        $headers[] = 'Connection: keep-alive';
        $headers[] = 'Accept-Language: ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3';
        $headers[] = 'Accept-Encoding: gzip,deflate,sdch';
        $headers[] = 'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.3';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://' . $this->url . '/user_settings_playlist.php?' .
            'user=' . $user .
            '&ts=' . $ts .
            '&tag=' . $tag .
            '&epg=' . $epg .
            '&cat=' . $cat .
            '&hls=' . $hls .
            '&cat_group=' . $cat_group .
            '&format=' . $format .
            '&USERNAME=' . $this->username .
            '&hash=' . $hash .
            '&typeresult=' . 'json'
        );


        curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/29.0.1547.57 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

