<?php
/**
 * Created by PhpStorm.
 * User: Mjx
 * Date: 2015/12/17
 * Time: 15:08
 */
class xmlWithArray{

    public static function xmlToarray($xml) {
        $tree = null;
        while($xml->read())
            switch ($xml->nodeType) {
                case \XMLReader::END_ELEMENT: return $tree;
                case \XMLReader::ELEMENT:
                    $node = array('tag' => $xml->name, 'value' => $xml->isEmptyElement ? '' : self::xmlToarray($xml));
                    if($xml->hasAttributes)
                        while($xml->moveToNextAttribute())
                            $node['attributes'][$xml->name] = $xml->value;
                    $tree[] = $node;
                    break;
                case \XMLReader::TEXT:
                case \XMLReader::CDATA:
                    $tree .= $xml->value;
            }
        return $tree;
    }

    public static function arrayToxmlelement($array){

        $xmlelement = '';
        foreach($array as $key=>$value){
            if(is_array($value)){
                if(array_key_exists('tag',$value)){
                    $xmlelement.='<'.$value['tag'];
                }

                if(array_key_exists('attributes',$value)){
                    if(is_array($value['attributes'])){
                        foreach($value['attributes'] as $k=>$v){
                            $xmlelement.=' '.$k.'="'.$v.'"';
                        }
                        $xmlelement.='>';
                    }
                    //$xmlelement.='>';
                }else{
                    $xmlelement.='>';
                }

                if(array_key_exists('value',$value)){
                    if(is_array($value['value'])){
                        $xmlelement.=self::arrayToxmlelement($value['value']).'</'.$value['tag'].'>';
                    }else{
                        $xmlelement.=$value['value'].'</'.$value['tag'].'>';
                    }
                }
            }
        }
        return $xmlelement;
    }

    public static function arrayToxml($array,$version,$encoding){

        $xml.='<?xml version="'.$version.'" encoding="'.$encoding.'" ?>';
        $ret = self::arrayToxmlelement($array);

        $xml.=$ret;
        return $xml;

    }



}