<?php

class Type {

    public $open_ended = "open_ended";
    public $likert     = "likert";
    public $checkboxes = "checkboxes";

}

class Response {

    public $id;
    public $token;
    private $queries;

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
