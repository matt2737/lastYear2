<?php
        session_start();
		ob_start();
		include_once("Gatherer.php");
        if(isset($_SESSION['id']))
        {
                $SID = $_SESSION['id'];
        }
        else
        {
                header('Location: login.php');
        }
	
        $gatherer = new Gatherer();
	$userDetails = $gatherer->getUserDetails($SID);
	if($userDetails['role'] == 2 && empty($_SESSION['userId'])){
		header('Location: search.php');	
	}
	$noteid = $_POST['noteid'];
        $note = $_POST['note'];
        $subject = $_POST['subject'];
        $priority = $_POST['priority'];
	
		if(isset($_POST['noteid']))
		{
			$result = $gatherer->updateNote($noteid, $note);	
		}
        elseif(isset($_POST['note'])){
		if($userDetails['role'] == 1){
			$noteId = $gatherer->addNewNote($SID, $note, $subject, $priority, $SID);
		}
		else{
			$noteId = $gatherer->addNewNote($SID, $note, $subject, $priority, $_SESSION['userId']);
		}
        }
	
	$userDetails = $gatherer->getUserDetails($SID);
	if($userDetails['role'] == 1){
		$result = $gatherer->getNotesForPatient($SID, 0);
	}
	else{
		$result = $gatherer -> getNotesByPatientId($_SESSION['userId'], 0, 10);
	}
	$userInfo = $gatherer->getUserDetails($SID);
?>

<!DOCTYPE html>
<html lang="en">
        <head>
                <LINK REL=StyleSheet HREF="css/bootstrap.min.css" TYPE="text/css">
        </head>
        <body>
		<div class="container-fluid">
                        <div class="navbar">
                                <div class="navbar-inner">
                                        <a class="brand" href="#">NuVista</a>
                                        <ul class="nav">
                                                <li><a href="summary.php">Health Summary</a></li>
                                                <li><a href="demographics.php">Demographics</a></li>
                                                <li class="active"><a href="#">Progress Notes</a></li>
						<?php if ($userDetails['role']==2) : ?>
						<li><a href="search.php">Search</a></li>
						<?php endif ?>
						<li><a href="logout.php">Logout</a></li>
                                        </ul>
                                </div>
                        </div>
			<h1>Progress Notes <small><?= $userInfo[firstName] ?> <?= $userInfo[lastName] ?></small></h1><br>
                        <div class="row-fluid">
				<div class="span3 offset1">
					<form action="progressNoteEdit.php" action="POST">
						<h3>Notes <button type="submit" class="btn btn-primary">Add New Note</button></h3>  
					</form>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span10 offset1">
					<table class="table table-bordered">
					<?php for($i = 0; $i < count($result); $i++): ?>
					<tr><td>
						<?php $creator = $gatherer->getUserDetails($result[$i][createdBy]) ?>
						<?= $result[$i][createDate] ?> <br>Created by: <?= $creator[firstName]?> <?= $creator[lastName]?>
						<a href="#" onclick="location.href='progressNoteEdit.php?noteId=<?=$result[$i][id]?>'"> Edit </a>
						<a href="#" onclick="location.href='deletenote.php?noteId=<?=$result[$i][id]?>'"> Delete</a><br>
						<button class="btn btn-primary btn-small" onclick="subjectClick(<?=$result[$i][id]?>);"><?=$result[$i][subject]?> <span class="caret"></span></button><br><br>
						<div id="<?=$result[$i][id] ?>" class="note" style="display:none;"><p class="lead"><?=$result[$i][note]?></p></div>
					</td></tr>
					<?php endfor; ?>
					</table>
				</div>
			</div>
						
				
                                
                </div>
                <script>
                function load(){

                }
                function subjectClick(id)
                {
                        var note = document.getElementById(id);
                        if(note.style.display == "block")
                        {
                                note.style.display = "none";
                        }
                        else
                        {
                                note.style.display = "block";
                        }
                }
                window.onload=load;
                </script>
        </body>
</html>

