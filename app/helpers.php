<?php

use Illuminate\Support\Facades\Http;

    function getYoutubeEmbedUrl($url)
        {
            $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
            $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
            $youtube_id = '';
            if (preg_match($longUrlRegex, $url, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }

            if (preg_match($shortUrlRegex, $url, $matches)) {
                $youtube_id = $matches[count($matches) - 1];
            }

            return 'https://www.youtube.com/embed/'.$youtube_id;

        }

     if (!function_exists('check_permission')) {
    function check_permission($permission): bool
    {
        if (auth()->check()) {
            if (auth()->user()->user_role == 'super_admin' || auth()->user()->hasAnyPermission($permission)) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('check_access')) {
    function check_access($permission): bool
    {
        if (auth()->check()) {
            if (auth()->user()->user_role == 'super_admin' || auth()->user()->hasPermissionTo($permission)) {
                return true;
            }
        }
        return false;
    }
}

        if (!function_exists('send_sms')) {
            function send_sms($phone, $message)
            {
                $msisdn=trim($phone);
                $n = strlen($msisdn);
                if ($n==11){
                    $msisdn = '88' . $msisdn;
                }

                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . '',
                ])->post("", [
                    'recipient' => $msisdn,
                    'sender_id' => "",
                    'type' => "plain",
                    'message' => $message,
                ]);
                 return $response;

            }
        }


    ?>
