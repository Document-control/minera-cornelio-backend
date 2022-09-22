<?php


namespace App\Http\Services;

use Illuminate\Http\Request;

// date_default_timezone_set('America/Lima');

class XHR
{
    public static function header_str2arr($header)
    {
        $header_lines = explode("\r\n", $header);
        $header_arr = [];
        $header_arr['status'] = $header_lines[0];
        for ($i = 1; $i < sizeof($header_lines) - 2; $i++) {
            $header_line = explode(': ', $header_lines[$i]);
            $header_arr[$header_line[0]] = $header_line[1];
        }
        return $header_arr;
    }
    public static function header_arr2str($header)
    {
        $header_str = '';
        $i = -1;
        foreach ($header as $key => $value) {
            if (++$i > 0) {
                $header_str .= "\r\n";
            }
            $header_str .= $key . ': ' . $value;
        }
        return explode("\r\n", $header_str);
    }
    public static function fetch($url, $options = [])
    {
        $method = strtoupper(@$options['method'] ?: 'get');
        $headers = @$options['headers'] ?: [];
        $body = @$options['body'];
        $curl_handle = curl_init($url);
        curl_setopt_array($curl_handle, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_HEADER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_POST => $method == 'POST',
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_HTTPHEADER => XHR::header_arr2str($headers),
        ]);
        $http_data = curl_exec($curl_handle);
        $curl_info = curl_getinfo($curl_handle);
        $body_start = $curl_info['header_size'];
        curl_close($curl_handle);
        return [
            'headers' => XHR::header_str2arr(substr($http_data, 0, $body_start)),
            'body' => substr($http_data, $body_start),
        ];
    }
}
final class Eldni
{
    public $laravel_session = null;
    public $body_token = null;

    // public function __construct(Request $request)
    // {
    //     $this->laravel_session = $request->bearerToken();
    // }

    public function set_tokens($attempts = 0)
    {
        $resp = XHR::fetch('https://eldni.com');
        $ix = strpos($resp['body'], 'name="_token" value="') + 21;
        $this->body_token = substr($resp['body'], $ix, strpos(substr($resp['body'], $ix), '">'));
        $cookies = explode('; ', $resp['headers']['set-cookie']);
        foreach ($cookies as $cookie) {
            if (substr($cookie, 0, 15) == 'laravel_session') {
                $this->laravel_session = $cookie;
            }
        }
        if (empty($this->laravel_session) && $attempts < 3) {
            $this->set_tokens($attempts + 1);
        }
    }
    public function get_name($dni = '')
    {
        $this->set_tokens();
        $dni = strval($dni);
        $mp_boundary = 'WebKitFormBoundary343FWlwl6H6ui0ZX';
        $resp = XHR::fetch('https://eldni.com/pe/buscar-por-dni', [
            'method' => 'POST',
            'headers' => [
                'content-type' => 'multipart/form-data; boundary=----' . $mp_boundary,
                'cookie' => $this->laravel_session,
            ],
            'body' => implode("\r\n", [
                '------' . $mp_boundary, 'Content-Disposition: form-data; name="_token"', '', $this->body_token,
                '------' . $mp_boundary, 'Content-Disposition: form-data; name="dni"', '', $dni,
                '------' . $mp_boundary . '--', ''
            ])
        ])['body'];
        return $this->get_people_dict($resp);
    }
    public function get_people_dict($resp)
    {
        $ix = strpos($resp, '<tbody>', strpos($resp, 'table table-striped table-scroll')) + 7;
        $data = substr($resp, $ix, strpos(substr($resp, $ix), '</tbody>') - 7);
        $dataf = '';
        for ($i = 0; $i < strlen($data); $i++) {
            if (substr($data, $i, 16) == '<th colspan="4">') {
                while (substr($data, $i, 5) != '</th>') $i++;
            }
            $dataf .= $data[$i];
        }
        $dict = [];
        $dataf = explode('</tr>', $dataf);
        $dataf = array_map(function ($row) {
            $row = str_replace('/', '', $row);
            $row = str_replace('<th>', '', $row);
            $row = str_replace('<tr>', '', $row);
            $row = str_replace('<td>', '', $row);
            $row = trim($row);
            $row = explode("\n", $row);
            $row = array_filter($row);
            return $row;
        }, $dataf);
        $dataf = array_filter($dataf);
        foreach ($dataf as $row) {
            $dict[$row[0]] = [
                'nombres' => trim($row[1]),
                'apellido_p' => trim($row[2]),
                'apellido_m' => trim($row[3]),
            ];
        }
        return $dict;
    }
}

// $siteSession = new SiteSession;
// $dni_prueba = '74935071';
// var_dump($siteSession->get_name($dni_prueba));
