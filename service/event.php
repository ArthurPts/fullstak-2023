<?php
require_once("conn.php");

class event extends connection
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getGrupEvent($pIdGrup)
    {
        $sql = "SELECT * FROM event WHERE idgrup = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $pIdGrup);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
    
    public function getEventDetail($pIdEvent)
    {
        $sql = "SELECT * FROM event WHERE idevent = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $pIdEvent);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    public function insertEvent($pIdGrup, $pJudul, $pSlug, $pTanggal, $pKeterangan, $pJenis, $pPosterExt)
    {
        $sql = "INSERT INTO event(idgrup, judul, `judul-slug`, tanggal, keterangan, jenis, poster_extension) VALUES(?,?,?,?,?,?,?)";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('issssss', $pIdGrup, $pJudul, $pSlug, $pTanggal, $pKeterangan, $pJenis, $pPosterExt);
        return $stmt->execute();
    }

    public function deleteEvent($pIdEvent)
    {
        $sql = "DELETE FROM event WHERE idevent=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("i", $pIdEvent);
        return $stmt->execute();
    }
    

    public function updateEvent($pIdEvent, $pJudul, $pSlug, $pTanggal, $pKeterangan, $pJenis, $pPosterExt)
    {
        $sql = "UPDATE event SET judul=?, judul-slug=?, tanggal=?, keterangan=?, jenis=?, poster_extension=? WHERE idevent=?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param('ssssssi', $pJudul, $pSlug, $pTanggal, $pKeterangan, $pJenis, $pPosterExt, $pIdEvent);
        return $stmt->execute();
    }

    public function generateEventId()
    {
        // Query untuk mengambil ID terakhir
        $sql = "SELECT idevent FROM event ORDER BY idevent DESC LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $stmt->bind_result($lastId);
        $stmt->fetch();
        $stmt->close();

        // Jika masih kosong, mulai dari 1
        if ($lastId === null) {
            return 1;
        }

        // Kembalikan ID terakhir + 1 (jika ingin ID baru)
        return $lastId + 1;
    }
}
?>
