<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function pull(Request $request)
    {

        $request_data = file_get_contents('php://input');

        $Signature = hash_hmac('sha1', $request_data, 'liumingsongning');
        echo $Signature;
        echo $Signature== $request->header('X-Hub-Signature');
        if ($Signature == $request->header('X-Hub-Signature')) {

            $path = base_path();
            $id = json_decode($request->payload)->repository->id;
            echo($id);
            switch ($id) {
                case '135518485':
                    shell_exec("cd {$path} && sudo /usr/bin/git reset --hard origin/master && sudo /usr/bin/git clean -f && sudo /usr/bin/git pull 2>&1");
                    break;
                default:
                    # code...
                    break;
            }
        }
    }
}
