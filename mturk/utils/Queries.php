<?php

class Queries {

    private $db;
    private $queries;
    
    public function __construct($ini_file)
    {
        $parsed = parse_ini_file($ini_file);
        $this->db = new mysqli($parsed['host'], $parsed['username'], $parsed['password'], $parsed['database']);
        $this->queries = new stdClass();
        $this->queries->new_response = $this->db->prepare("INSERT INTO responses (mturk_token, started) VALUES (?, NOW())");
        $this->queries->update_response_time = $this->db->prepare("UPDATE responses SET modified=NOW() WHERE id=?");
        $this->queries->get_token = $this->db->prepare("SELECT mturk_token FROM responses WHERE id=?");
    }
    
    public function new_response($token){
        $this->queries->new_response->bind_param('s', $token);
        if(!$this->queries->new_response->execute()){
            if($this->db->errno){
                return null;
            }
        }
        return $this->db->insert_id;
    }
    
    public function touch_response($id){
        $this->queries->update_response_time->bind_param('i', $id);
        $this->queries->update_response_time->execute();
    }

    public function get_token($id){
        $this->queries->get_token->bind_param('i', $id);
        $this->queries->get_token->execute();
        $result = $this->queries->get_token->get_result()->fetch_row();
        return $result[0];
    }
    
    public function add_likert($response_id){
        
        
    }


}