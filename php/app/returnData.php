<?php

    class returnData{
        /*  封装接口数据类
         * */


        /*  综合（json/xml）格式返回接口数据
         *  @param interage $code 状态码
         *  @param string $message 状态信息
         *  @param array $data 数据
         *  return string
         * */
        public static function show($code, $message, $data=array()){

            if(!is_numeric($code)){
                return '';
            }

            if(!isset($_GET['type']) || $_GET['type'] == 'json'){
                self::returnJson($code, $message, $data);
            }elseif($_GET['type'] == 'xml'){
                self::returnXml($code, $message, $data);
            }

        }




        /*  json格式返回接口数据
         *  @param interage $code 状态码
         *  @param string $message 状态信息
         *  @param array $data 数据
         *  return string
         * */
        public static function returnJson($code, $message, $data=array()){
            if(!is_numeric($code)){
                return '';
            }
            $result = array(
                'code' => $code,
                'message'  => $message,
                'data' => $data
            );
            echo json_encode($result);
            exit;
        }




        /*  xml格式返回接口数据
         *  @param interage $code 状态码
         *  @param string $message 状态信息
         *  @param array $data 数据
         *  return string
         * */
        public static function returnXml($code, $message, $data=array()){
            if(!is_numeric($code)){
                return '';
            }
            $result = array(
                'code' => $code,
                'message' => $message,
                'data' => $data
            );
            header("Content-type:text/xml");
            $xml = "<?xml version='1.0' encoding='UTF-8' ?>";
            $xml .= "<root>";
            $xml .= self::xmlEncode($result);
            $xml .= "</root>";

            echo $xml;
            exit;
        }




        /*
         *  将数组转为xml
         *  @param array $data
         *  return string
         * */
        public static function xmlEncode($data){
            $xml = $attr = '';
            foreach($data as $k=>$v){
                if(is_numeric($k)){
                    $attr = " id='{$k}'";
                    $k = "item";
                }
                $xml .= "<{$k}{$attr}>";
                $xml .= is_array($v) ? self::xmlEncode($v) : $v;
                $xml .= "</{$k}>";
            }
            return $xml;
        }


    }//classend







    // $arr = array(
    //     'sex' => 'man',
    //     'name' => 'roger',
    //     'type' => array(8585,1314)
    // );
    // returnData::returnXml(200, 'success',$arr);