<?php
/**
 * Created by PhpStorm.
 * User: Andrei Siarheyeu <andreylong@gmail.com>
 * Date: 2019-08-27
 * Time: 17:12
 */

namespace App\Services;


use App\Model\RemoteCommand;
use App\Services\Contracts\RemoteSystemCommandContract;
use GuzzleHttp\Client;

class RemoteSystemCommandService implements RemoteSystemCommandContract
{
    public function add( $name, $host )
    {
        $command = new RemoteCommand([
            'key'       => \Str::random(24),
            'command'   => $name,
            'host'      => $host
        ]);

        $command->save();

        $host_config = config('puppet_hosts')[$host];

        $client = new Client();

        $url = $host_config['protocol'].$host_config['host'].'/'.$host_config['command_uri'];


        $headers = [
            'Accept'     => 'application/json'
        ];

        $options = ['form_params' => [
            'command'   => $command->command,
            'key'       => $command->key
        ]];

        $options['headers'] = $headers;

        if (isset($host_config['user']) && isset($host_config['password'])) {
            $options['auth'] = [$host_config['user'], $host_config['password']];
        }

        $client->post($url, $options);

        return $command;
    }
}
