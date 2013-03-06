<?php
        session_start();
        ob_start();
        include_once("Gatherer.php");
        $gatherer = new Gatherer();

        if(isset($_SESSION['id']))
        {
                $SID = $_SESSION['id'];
        }
        else
        {
                header('Location: login.php');
        }

        $noteId = $_GET['noteId'];
        $result = $gatherer->deleteNote($noteId);
        header('Location: progressNotes.php');
?>

