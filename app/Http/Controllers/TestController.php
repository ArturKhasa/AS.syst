<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\DeleteTempFilesJob;
use App\Mail\FormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class TestController extends Controller
{
    public function test(){

//        $python =  shell_exec('python C:\Users\Артур\PycharmProjects\pythonProject\test.py');
//        $process = new Process(['python','C:\Users\Артур\PycharmProjects\pythonProject\test.py']);

        $process = Process::fromShellCommandline('python C:\Users\Артур\PycharmProjects\pythonProject\face_detect.py');
        $process->run();


        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput();

        return $data;
    }

    public function index()
    {
//        $redis = Redis::connection();
//        $redis->set('loh', 'xui');
//        Log::channel('supervisor')->info('xui');
//        DeleteTempFilesJob::dispatch('loh');
        Mail::to('vadim.4392@mail.ru')->send(new FormMail());
        return 'loh';
    }
}
