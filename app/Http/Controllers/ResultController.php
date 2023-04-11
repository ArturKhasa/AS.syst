<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResultController extends Controller
{
    protected $countUsers;

    const HAPPY = 'happy';
    const ANGRY = 'angry';
    const FEAR = 'fear';
    const SAD = 'sad';
    const SURPRISE = 'surprise';
    const NEUTRAL = 'neutral';

    public function index(Request $request)
    {
        $data = file_get_contents(storage_path() . '/app/public/result.json');

        $result = json_decode($data, true);

        $this->getCountUsers($result);


        return [
            'result' => array_values($this->getAvg($result)),
            'sum'    => collect($this->getAvg($result))->sum()
        ];
    }

    private function getCountUsers($data)
    {
        $count = 0;

        foreach ($data as $key => $value) {
            if ($key > 0)
                break;
            else {
                for ($i = 0; $i < count($value); $i++) {
                    if (isset($value['box' . $i]))
                        $count++;
                }
            }
        }

        $this->countUsers = $count;
    }

    private function getAvg($data)
    {
        $fon = [];

        for ($i = 0; $i < $this->countUsers; $i++) {
            $fon[self::ANGRY][] = collect($data)->avg(self::ANGRY . $i);
            $fon[self::HAPPY][] = collect($data)->avg(self::HAPPY . $i);
            $fon[self::FEAR][] = collect($data)->avg(self::FEAR . $i);
            $fon[self::SAD][] = collect($data)->avg(self::SAD . $i);
            $fon[self::SURPRISE][] = collect($data)->avg(self::SURPRISE . $i);
            $fon[self::NEUTRAL][] = collect($data)->avg(self::NEUTRAL . $i);
        }

        return [
            self::HAPPY    => round(collect($fon[self::HAPPY])->avg(), 2) * 100,
            self::SAD      => round(collect($fon[self::SAD])->avg(), 2) * 100,
            self::FEAR     => round(collect($fon[self::FEAR])->avg(), 2) * 100,
            self::ANGRY    => round(collect($fon[self::ANGRY])->avg(), 2) * 100,
            self::NEUTRAL  => round(collect($fon[self::NEUTRAL])->avg(), 2) * 100,
            self::SURPRISE => round(collect($fon[self::SURPRISE])->avg(), 2) * 100
        ];
    }
}
