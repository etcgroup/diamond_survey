<?php

class Type {

    public $open_ended = "open_ended";
    public $likert     = "likert";
    public $checkboxes = "checkboxes";

}

class Response {

    private $queries;
    private $id;
    private $token;

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
            echo $this->queries->get_token($this->id);
        } else {
            $this->id = $id;
            $this->token = $this->queries->get_token($id);
        }
    }

    public function finish() {
        $this->queries->touch_response($this->id);
    }

    public function answer($question, $type, $answer) {
        if ($type == Type::$open_ended) {
            
        } else if ($type == Type::$likert) {
            
        } else if ($type == Type::$checkboxes) {
            $this->queries->add_checkbox($question, );
        } else {
            return
        }
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
