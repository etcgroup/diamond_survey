<?php

class Response {

    public $id;
    public $token;
    private $queries;

    private static $open_ended = "open-ended";
    private static $time = "-time";

    public function __construct($id = null, $queries = null) {
        $this->queries = isset($queries) ? $queries : new Queries("db.ini");
        if ($id == null) {
            while (true) {
                $this->token = self::get_token();
                $this->id = $this->queries->new_response($this->token);
                if ($this->id !== false) {
                    break;
                }
            }
        } else {
            $this->id = $id;
            $this->token = $this->queries->get_token($id);
        }
    }

    public function answer_question($question, $answer) {
        if (substr($question, 0, strlen(self::$open_ended)) == self::$open_ended) {
            $parts = explode("-",$question);
            $scenario = null;
            if(is_numeric($parts[2])){
                $scenario = (int)$parts[2];
            }
            $new_question = "";
            for($i=($scenario==null?2:3); $i<count($parts); $i++){
                if($new_question!="")
                    $new_question.="-";
                $new_question .= $parts[$i];
            }
            $this->queries->add_open_ended($this->id, $question, $scenario, $answer);
        } else if (substr($question, strlen($question)-strlen(self::$time)) == self::$time){
            $this->queries->add_time($this->id, substr($question,0,strlen($question)-strlen(self::$time)), (int) $answer);
        } else if (is_numeric($answer)) {
            $this->queries->add_likert($this->id, $question, (int) $answer);
        } else {
            $this->queries->add_sort($this->id, $question, $answer);
        }
    }

    public function finish() {
        $this->queries->touch_response($this->id);
    }

    private static function get_token($length = 8) {
        $consonants = "bcdfgjkmnprstvwz";
        $vowels = "aeio";
        $token = "";
        $letters = 0;
        while (strlen($token) < $length) {
            $letters+=2;
            $consonant = mt_rand(0, strlen($consonants) - 1);
            $vowel = mt_rand(0, strlen($vowels) - 1);
            $token .= $consonants[$consonant] . $vowels[$vowel];
            if ($letters % 4 == 0) {
                $token.=" ";
            }
        }
        return strtoupper($token);
    }

}

?>
