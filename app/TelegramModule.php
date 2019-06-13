<?php
if(!function_exists('sendMessage')) { 
    function sendMessage($text, $chat_id) {
        $telegramToken = env('TELEGRAM_TOKEN');
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => 'https://api.telegram.org/bot' . $telegramToken . '/sendMessage',
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE, 
                CURLOPT_TIMEOUT => 10,
                CURLOPT_POSTFIELDS => array(
                    'chat_id' => $chat_id,
                    'text' => $text,
                ),
            )
        );
       curl_exec($ch);
       dd($ch);
    };
}