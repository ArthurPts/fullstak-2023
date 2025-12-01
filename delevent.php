<?php
    require_once ("service/event.php");
    $objEvent = new event();

    $id = $_GET['id'];
      
        if ($objEvent->deleteEvent($id)) {
            $msg = "Event berhasil dihapus.";
            echo "<script>alert('Event berhasil dihapus.');</script>";
            header("Location: index.php");
            exit();
        } else {
            $msg = "Event gagal dihapus.";
            echo "<script>alert(Event gagal dihapus dari grup )";
            header("Location: index.php");
            exit();
        }


?>