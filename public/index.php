<?php
/**
 * Serve remote URL content through App Engine by using Memcache. Pretty interesting.
 * It's really cool!
 *
 * @Author Shaharia Azam <shaharia@previewtechs.com>
 */
define("KB_JSON_URL", "https://YOUR-WEBSITE-ADDRESS/wp-json/wp/v2");

$memcached = new Memcached();
$memcached->addServers([
    ['localhost', 11211, 33]
]);

/**
 * @param $url
 * @param string $method
 * @return mixed
 */
function fetchJSONFromRemoteWP($url, $method = 'GET')
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_MAXREDIRS => 2,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => [],
    ));

    $data = curl_exec($curl);
    curl_error($curl);
    curl_close($curl);

    return $data;
}

$remoteUrl = KB_JSON_URL . $_SERVER['REQUEST_URI'];

$cacheKey = base64_encode($remoteUrl);

$content = $memcached->get($cacheKey);
if (!empty($content)) {
    $data = $content;
} else {
    $data = fetchJSONFromRemoteWP($remoteUrl);
    $memcached->set($cacheKey, $data, 360000);
}

header('Content-Type: application/json');
echo json_encode(json_decode($data, true));

exit;