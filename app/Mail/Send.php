<?php
namespace App\Mail;

class Send
{
    /**
     * Get Host
     *
     * @return string
     */
    private static function getHost() {
        return "https://notifications.infogari.eu";
    }

    private static function getToken(){
        return "xdrfRE62fi7W112QzH9eF.JP9UloCnthQ3expBvV5REvfXdU0q966";
    }

    public static function send($type, $to, $subject, $message, $attach = []){

        $_SERVER['HTTP_HOST'] = isset($_SERVER['HTTP_HOST'])?$_SERVER['HTTP_HOST']:env('APP_URL');
        if (count(explode('/',$_SERVER['HTTP_HOST']))>1) {
            $_SERVER['HTTP_HOST'] = explode('/',$_SERVER['HTTP_HOST']);
            $_SERVER['HTTP_HOST'] = end($_SERVER['HTTP_HOST']);
        }

        if ($type=='sms') $type = 2;
        if ($type=='email') $type = 1;
        if ($type=='telegram') $type = 3;


        $params = ["subject"=>$subject,"message"=>$message,"send_to"=>$to,'referrer'=>$_SERVER['HTTP_HOST'],'notification_type_id'=>$type];
        if (!empty($attach)){
            $params['attachments'] = [$attach];
        }
        $headers = [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Encoding: gzip, deflate',
            'Accept-Language: en-US,en;q=0.5',
            'Cache-Control: no-cache',
            'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
            'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
            'auth-token: '.self::getToken()
        ];

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,self::getHost()."/api/outbox");
        curl_setopt($ch,CURLOPT_POST, true);                //0 for a get request
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        $response = curl_exec($ch);
        curl_close ($ch);
        $json = json_decode($response);
        return $json;
    }
}
