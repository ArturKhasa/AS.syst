<?php

namespace App\Http\Controllers;

use App\Http\Messages\Constants;
use App\Http\Requests\ResultVideoRequest;
use App\Jobs\DeleteTempFilesJob;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResultController extends Controller
{
    protected $countUsers;

    const HAPPY = 'happy';
    const ANGRY = 'angry';
    const FEAR = 'fear';
    const SAD = 'sad';
    const SURPRISE = 'surprise';
    const NEUTRAL = 'neutral';

    public function index(ResultVideoRequest $request)
    {
        $sessionKey = Str::random(36);
//        $data = file_get_contents(storage_path() . '/app/public/result.json');
//        $result = json_decode($data, true);

        if ($request->file('video')) {
            $file = $request->file('video');
            $extension = $file->getClientOriginalExtension();
            $extension = $extension == 'MOV' ? 'mp4' : $extension;

            $fileUrl = self::removeFileExtension($file->store('public/videos/' . $sessionKey));
            $resFileName = mb_substr($fileUrl, 14);
            $resultUrl = base_path() . '/storage/app/' . $fileUrl . '.' . $extension;
        };

        $command = escapeshellcmd('python3' . ' ' . base_path() . '/predict.py' . ' ' . $resultUrl);
        exec($command, $output);

        $test = [];
        foreach ($output as $key => $out) {
            $test[$key] = json_decode($out, true);
        }

        $result = json_decode($test[0], true);
        $this->getCountUsers($result);

        $avg_result = array_values($this->getAvg($result));
        $sum_result = collect($this->getAvg($result))->sum();

        $catalog = storage_path() . '/app/public/videos/' . $sessionKey;
        exec("chmod -R 777 $catalog");
        DeleteTempFilesJob::dispatch($catalog)
            ->delay(now()->addMinutes(10));

        return [
            'result'  => $avg_result,
            'sum'     => $sum_result,
            'countPerson' => $this->countUsers,
            'report' => $this->getReport($avg_result),
            'fileUrl' => 'storage/videos/'. $resFileName . '.' . $extension,
            'resPhoto' => 'storage/videos/'. $resFileName . '190.' . 'jpg',
            'emotion' => $this->getEmotion($avg_result),
            'session_key' => $sessionKey
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

    public static function removeFileExtension($fileName)
    {
        return substr($fileName, 0, strrpos($fileName, '.'));
    }

    private function getReport($data)
    {
        $maxvalue = max($data);
        $maxIndex = 0;

        while (list($key,$value) = each($data)){

            if ($value == $maxvalue) $maxIndex = $key;

        }

        switch ($maxIndex) {
            case 0:
                 return Constants::MAX_HAPPY;
            case 1:
                return Constants::MAX_SAD;
            case 2:
                return Constants::MAX_FEAR;
            case 3:
                return Constants::AVG_ANGRY;
            case 4:
                return Constants::MAX_NEUTRAL;
            default:
                return Constants::MAX_SURPRISE;
        }
    }

    private function getEmotion($data)
    {
        $maxvalue = max($data);

        while (list($key,$value) = each($data)){

            if ($value == $maxvalue) $maxIndex = $key;

        }

        switch ($maxIndex) {
            case 0:
                return Constants::HAPPY;
            case 1:
                return Constants::SAD;
            case 2:
                return Constants::FEAR;
            case 3:
                return Constants::ANGRY;
            case 4:
                return Constants::NEUTRAL;
            case 5:
                return Constants::SURPRISE;
            default:
                return 'Не определено';
        }
    }
}
