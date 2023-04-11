<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class TestController extends Controller
{
    public function test(Request $request){

//        $python =  shell_exec('python C:\Users\Артур\PycharmProjects\pythonProject\test.py');
//        $process = new Process(['python','C:\Users\Артур\PycharmProjects\pythonProject\test.py']);

        $process = Process::fromShellCommandline('python C:\Users\Артур\PhpstormProjects\AS.syst\pytonscripts\test.py');
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $data = $process->getOutput();

        dd($data);
    }
}
