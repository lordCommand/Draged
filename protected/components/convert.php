<?php
/**
 * User: Command
 * Date: 02.02.12
 * Time: 17:54
 */

class convert
{
    protected $test = array(
        array(
            "value" => "bla",
            "type" => "echo",
            "child"=>NULL
        ),
        array(
            "value"=>"0",
            "type" => "var",
            "name"=>"vari",
            "child"=>NULL
        ),
        array(
            "value" => "vari == 0",
            "type" => "if",
            "child"=>array(
                array(
                            "value" => "bla 1",
                            "type" => "echo",
                            "child"=>NULL
                        ),
            )
        ),
    );
    private $sprache;
    private $ele;

    function __construct($sprache){
        $this->sprache = Sprache::model()->findByPk($sprache);//("name=:name",array(':name'=>$sprache));
        $elements = $this->sprache->elements;
        $this->ele = array();
        foreach($elements as $e){
            $this->ele[$e->name] = $e->attributes;
        }
        //CVarDumper::dump($this->ele,10,true);

    }
    function parse($input){
        if($input == "debug")$input = $this->test;
        if(!is_array($input))  throw new CHttpException(400, Yii::t('app', 'Kein ARRAY!'));
        $returnString = "";
        foreach($input as $element){
            $return = $this->ele[$element['type']]['expression'];
            $return = str_replace('$name',$element['name'],$return);
            $return = str_replace('$value',$element['value'],$return);
            if($element['child']!=NULL){
                $return = str_replace('$child',$this->parse($element['child']),$return);
            }
            $returnString .= $return."\n";
        }
        return $returnString;
    }
}
