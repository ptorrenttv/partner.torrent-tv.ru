<?php

namespace TorrentTv\PartnerApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Psr7\Request;

/**
 * PHP обертка над http://partner.torrent-tv.ru/api.php
 */
class PartnerApi
{
    /**
     * Базовая URI для выполнения запросов.
     */
    const BASE_URI = 'http://partner.torrent-tv.ru/api/';

    /**
     * Формат плейлиста M3U.
     */
    const FORMAT_M3U = '0001';
    /**
     * Формат плейлиста XSPF.
     */
    const FORMAT_XSPF = '0010';

    /**
     * PartnerApi constructor.
     *
     * Get your credentials on http://partner.torrent-tv.ru/api.php page.
     *
     * @param string $username your USERNAME.
     * @param string $key your KEY.
     * @param array $guzzleConfig optional guzzle client configuration.
     */
    public function __construct($username, $key, $guzzleConfig = [])
    {
        $this->username = $username;
        $this->key = $key;
        $this->client = new Client(array_merge($guzzleConfig,
            ['base_uri' => static::BASE_URI, 'http_errors' => true]));
    }

    /**
     * Регистрация пользователя.
     *
     * @param string $user имя пользователя
     * @param string $notes заметки (до 200 символов текста)
     * @return array|null
     * @throws TransferException
     */
    public function addUser($user, $notes)
    {
        return $this->sendRequest('user_add', ['user' => $user, 'notes' => $notes]);
    }

    /**
     * Удаление пользователя.
     *
     * @param string $user имя пользователя
     * @return array|null
     * @throws TransferException
     */
    public function deleteUser($user)
    {
        return $this->sendRequest('user_del', ['user' => $user]);
    }

    /**
     * Получить информацию по пользователю.
     *
     * @param string $user имя пользователя
     * @return array|null
     * @throws TransferException
     */
    public function getUserInfo($user)
    {
        return $this->sendRequest('user_info', ['user' => $user]);
    }

    /**
     * Получить информацию по всем пользователям.
     *
     * @return array|null
     * @throws TransferException
     */
    public function getAllUsersInfo()
    {
        return $this->sendRequest('user_info', ['all' => '']);
    }

    /**
     * Сменить ссылку на плейлист для клиента.
     *
     * @param string $user имя пользователя
     * @return array|null
     * @throws TransferException
     */
    public function updateUserToken($user)
    {
        return $this->sendRequest('user_set_token', ['user' => $user]);
    }

    /**
     * Подключение/продление подписки.
     *
     * @param string $user имя пользователя
     * @param int $period количество месяцев подписки
     * @return array|null
     * @throws TransferException
     */
    public function activateUserSubscription($user, $period = 1)
    {
        return $this->sendRequest('subscription_managment', ['user' => $user, 'period' => $period]);
    }

    /**
     * Сменить тип плейлиста, кодировку, формат плейлиста для клиента.
     *
     * @param string $user имя пользователя
     * @param bool $ts добавить префикс ts:// для формата m3u
     * @param bool $tag категории каналов спец. полями в m3u
     * @param bool $epg архив телепередач
     * @param bool $cat категории каналов в скобках
     * @param bool $hls технология HLS
     * @param bool $cat_group группировать по категориям
     * @param string $format формат плейлиста {@see static::FORMAT_M3U} или {@see static::FORMAT_XSPF}
     * @return array|null
     * @throws TransferException
     */
    public function setUserPlaylistOptions($user, $ts, $tag, $epg, $cat, $hls, $cat_group, $format)
    {
        return $this->sendRequest('user_settings_playlist', [
            'user' => $user,
            'ts' => intval($ts),
            'tag' => intval($tag),
            'epg' => intval($epg),
            'cat' => intval($cat),
            'hls' => intval($hls),
            'cat_group' => intval($cat_group),
            'format' => $format,
            // Hash params is different for this method
            'hash' => $this->hashParams(['user' => $user]),
        ]);
    }

    /**
     * Sends request to api and returns `data` part of response.
     *
     * `USERNAME` and `hash` params are set automatically.
     * But you may need to generate your own hash for some methods.
     *
     * @param string $method api method's name.
     * @param array $params request params.
     * @return array|null
     * @throws TransferException check {@see http://guzzlephp.org/ Guzzle documentation} for reference.
     * @throws ApiException in case of api errors, check {@see ApiException::getErrorCode()} for error code.
     */
    protected function sendRequest($method, $params)
    {
        $request = new Request('GET', "$method.php");
        $response = $this->client->send($request, [
            'query' => array_merge(
                ['hash' => $this->hashParams($params)],
                $params,
                ['USERNAME' => $this->username]
            ),
        ]);

        $json = json_decode($response->getBody(), true);
        if ($json === null) {
            throw new BadResponseException('Unable to decode json response', $request, $response);
        }
        if (!empty($json['error'])) {
            throw new ApiException($json['error'], $request, $response);
        }
        if (!isset($json['success']) || $json['success'] != 1) {
            throw new ApiException('n/a', $request, $response);
        }

        return isset($json['data']) ? $json['data'] : null;
    }

    /**
     * Returns hash of request params.
     *
     * @param array $params
     * @return string
     */
    protected function hashParams($params)
    {
        return md5(implode('.', array_merge([
            $this->username,
            $this->key,
        ], $params)));
    }
}
