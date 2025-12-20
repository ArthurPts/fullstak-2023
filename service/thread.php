<?php
require_once("conn.php");

class thread extends connection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getThreadList($pIdGrup){
        $sql = "SELECT * FROM thread t WHERE t.idgrup = ? order by tanggal_pembuatan desc";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $pIdGrup);
        
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function getChatList($pIdThread){
        $sql = "SELECT * FROM chat WHERE idthread = ?;";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $pIdThread);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function insertChat($pIdThread, $pUsername, $pIsi){
        $sql = "INSERT INTO chat 
                (idthread, username_pembuat, isi, tanggal_pembuatan)
                VALUES (?, ?, ?, NOW())";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("iss", $pIdThread, $pUsername, $pIsi);
        return $stmt->execute();
    }


    public function createThread($pIdGrup, $username){
        $sql = "INSERT INTO thread(username_pembuat, idgrup, tanggal_pembuatan, status) VALUES (?, ?, now(), 'Open') ;";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("si", $username, $pIdGrup);
        return $stmt->execute();

    }

    public function closeThread($pIdThread){
        $sql = "UPDATE thread SET status='Close' WHERE idthread=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('i', $pIdThread);
        return $stmt->execute();
    }

    
  
}