<?php

class RssReader{


    function fetch($url){

        $cacheDir = "cache/";
        $cacheName = base64_encode($url);
        $fullUrl = $cacheDir.$cacheName;
        $hasCache = is_file($fullUrl);
        
        require_once "lib/LogUtil.php";
        $logger = LogUtil::getLogger();
        if ( $hasCache ){ // �л����һ����ʱ�䲻����6Сʱ��ʹ�û���

            $t1 = filemtime($fullUrl);
            $t2 = time();
            $inter =  $t2 - $t1;

            if( $inter < 3600 * 6 ){
                
               
                $url = $fullUrl;
                
                $logger -> info("fullUrl = $fullUrl inter=$inter  t1=$t1");
            }else{
             $hasCache = false;
             $logger -> info("inter=$inter");   
            }
        }
        
        $logger -> info("url=$url");  

        $buff = "";

        $timeout=array(
        'http'=>array(
        'timeout'=>20 //��ʱʱ�䣬��λΪ��
        )
        );

        $ctx=stream_context_create($timeout);
        $fp = fopen($url,"r",false,$ctx);




        if( !$fp){ return false; }
        while ( !feof($fp) ) { $buff .= fgets($fp,4096); }
        fclose($fp);

        if(strlen($buff) <= 0){
            return false;
        }



        //$pattern="/<!\[CDATA\[(.*?)\]\]>/";
        //preg_match_all($pattern, $str,$out);
        //var_dump($out);

        $from_str ="encoding=\"gb2312\"";
        $to_str ="encoding=\"UTF-8\"";
        $char_set = mb_detect_encoding($buff);
        if( $char_set == 'UTF-8'){

        }else{
            $buff = mb_convert_encoding($buff,'utf-8','gb2312');
            $buff = str_replace($from_str,$to_str,$buff);
        }


        if ( !$hasCache){
            $cacheFp = fopen($fullUrl, 'w+');
            fwrite($cacheFp, $buff);
            fclose($cacheFp);
            $t3 = filemtime($fullUrl);
            $logger -> info("fullUrl=$fullUrl t3=$t3");
        }

        return simplexml_load_string($buff, 'SimpleXMLElement', LIBXML_NOCDATA );


    }

    function fetch_json($url){

        return json_encode($this->fetch($url));
    }
}