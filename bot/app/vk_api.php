<?php

function vkApi_messagesSend($peer_id, $message, $attachments = array())
{
    return _vkApi_call('messages.send', array(
        'peer_id' => $peer_id,
        'message' => $message,
        'attachment' => implode(',', $attachments)
    ));
}

function vkApi_usersGet($user_id)
{
    return _vkApi_call('users.get', array(
        'user_id' => $user_id,
    ));
}

function vkApi_photosGetMessagesUploadServer($peer_id)
{
    return _vkApi_call('photos.getMessagesUploadServer', array(
        'peer_id' => $peer_id,
    ));
}

function vkApi_photosSaveMessagesPhoto($photo, $server, $hash)
{
    return _vkApi_call('photos.saveMessagesPhoto', array(
        'photo' => $photo,
        'server' => $server,
        'hash' => $hash,
    ));
}

function vkApi_docsGetMessagesUploadServer($peer_id, $type)
{
    return _vkApi_call('docs.getMessagesUploadServer', array(
        'peer_id' => $peer_id,
        'type' => $type,
    ));
}

function vkApi_docsSave($file, $title)
{
    return _vkApi_call('docs.save', array(
        'file' => $file,
        'title' => $title,
    ));
}

function _vkApi_call($method, $params = array())
{
    $params['access_token'] = env('VK_ENDPOINT');
    $params['v'] = env('VK_API_VERSION', '5.199');

    $query = http_build_query($params);
    $url = env('VK_ENDPOINT') . $method . '?' . $query;

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    $error = curl_error($curl);
    if ($error) {
        error_log($error);
        throw new Exception("Failed {$method} request");
    }

    curl_close($curl);

    $response = json_decode($json, true);
    if (!$response || !isset($response['response'])) {
        error_log($json);
        throw new Exception("Invalid response for {$method} request");
    }

    return $response['response'];
}

function vkApi_upload($url, $file_name)
{
    if (!file_exists($file_name)) {
        throw new Exception('File not found: ' . $file_name);
    }

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array('file' => new CURLfile($file_name)));
    $json = curl_exec($curl);
    $error = curl_error($curl);
    if ($error) {
        error_log($error);
        throw new Exception("Failed {$url} request");
    }

    curl_close($curl);

    $response = json_decode($json, true);
    if (!$response) {
        throw new Exception("Invalid response for {$url} request");
    }

    return $response;
}