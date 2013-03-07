<?php

class Queries {

    private $db;
    private $queries;

    public function __construct($ini_file) {
        $parsed = parse_ini_file($ini_file);
        $this->db = new mysqli($parsed['host'], $parsed['username'], $parsed['password'], $parsed['database']);
        $this->queries = new stdClass();
        $this->queries->new_response = $this->db->prepare("INSERT INTO responses (mturk_token, started) VALUES (?, NOW())");
        $this->queries->update_response_time = $this->db->prepare("UPDATE responses SET modified=NOW() WHERE id=?");
        $this->queries->get_token = $this->db->prepare("SELECT mturk_token FROM responses WHERE id=?");
        $this->queries->add_sort_item = $this->db->prepare("INSERT INTO sorted (response_id, question, item, `order`) VALUES (?,?,?,?)");
        $this->queries->add_likert = $this->db->prepare("INSERT INTO likert (response_id, question, answer) VALUES (?,?,?)");
        $this->queries->add_time = $this->db->prepare("INSERT INTO time (response_id, action, `time`) VALUES (?,?,?)");
        $this->queries->add_open_ended = $this->db->prepare("INSERT INTO open_ended (response_id, question, scenario, answer) VALUES (?,?,?,?)");
    }       

    public function new_response($token) {
        $this->queries->new_response->bind_param('s', $token);
        if (!$this->queries->new_response->execute()) {
            if ($this->db->errno) {
                return null;
            }
        }
        return $this->db->insert_id;
    }

    public function touch_response($id) {
        $this->queries->update_response_time->bind_param('i', $id);
        $this->queries->update_response_time->execute();
    }

    public function get_token($id) {
        $this->queries->get_token->bind_param('i', $id);
        $this->queries->get_token->execute();
        $result = $this->queries->get_token->get_result()->fetch_row();
        return $result[0];
    }

    public function add_likert($id, $question, $rating) {
        $this->queries->add_likert->bind_param('isi', $id, $question, $rating);
        $this->queries->add_likert->execute();
    }

    public function add_time($id, $action, $time) {
        $this->queries->add_time->bind_param('isi', $id, $action, $time);
        $this->queries->add_time->execute();
    }

    public function add_sort($id, $question, $list) {
        $items = explode(" ", $list);
        foreach ($items as $order => $item) {
            if ($item == "") {
                continue;
            }
            $this->queries->add_sort_item->bind_param('issi', $id, $question, $item, $order);
            $this->queries->add_sort_item->execute();
        }
    }

    public function add_open_ended($id, $question, $scenario, $answer) {
        $this->queries->add_open_ended->bind_param('isis', $id, $question, $scenario, $answer);
        $this->queries->add_open_ended->execute();
    }

}