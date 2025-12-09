<?php
require_once("conn.php");

class thread extends connection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getThreadList($pIdGrup){
        $sql = "SELECT * FROM thread t WHERE t.idgrup = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $pIdGrup);
        
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getChatList($pIdThread){

    }

    public function closeThread($pIdThread){
        $sql = "UPDATE thread SET status='Close' WHERE idthread=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $pIdThread);
        return $stmt->execute();
    }

    
  
}