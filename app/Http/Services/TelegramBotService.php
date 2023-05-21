<?php


namespace App\Http\Services;


class TelegramBotService
{
    const BASE_CHAT = '959547936';
    const DOP_CHAT = '346051953';
    const SEND_MESSAGE_URL = 'https://api.telegram.org/bot6145631126:AAEUWcg0ruJPeIw7Mw4St8Xk_NztqxgRx2k/sendMessage';

    public static function sendMessage(array $data)
    {
        $message = new \StdClass();
        $message->name = $data['name'] ?? '';
        $message->surname = $data['surname'] ?? '';
        $message->email = $data['email'] ?? '';
        $message->phone = $data['phone'] ?? '';
        $message->text = $data['text'] ?? '';

        $obj = [
            'chat_id' => self::BASE_CHAT,
            'text' => "Имя: $message->name\nФамилия: $message->surname\nЭлектронный адрес: $message->email\nТелефон: $message->phone\nОбращение: $message->text"
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::SEND_MESSAGE_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($obj),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));


        $obj2 = [
            'chat_id' => self::DOP_CHAT,
            'text' => "Имя: $message->name\nФамилия: $message->surname\nЭлектронный адрес: $message->email\nТелефон: $message->phone\nОбращение: $message->text"
        ];

        $curl2 = curl_init();

        curl_setopt_array($curl2, array(
            CURLOPT_URL => self::SEND_MESSAGE_URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($obj2),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        $response = curl_exec($curl2);

        curl_close($curl);

    }

}
