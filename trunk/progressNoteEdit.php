<?php
        session_start();
		ob_start();
		include_once('Gatherer.php');
        if(isset($_SESSION['id']))
        {
                $SID = $_SESSION['id'];
        }
        else
        {
                header('Location: login.php');
        }

		$gatherer = new Gatherer();
		$isUpdate = false;
		// editing a note
		if(isset($_GET['noteId']))
		{
			$isUpdate = true;
			$noteId = $_GET['noteId'];
			$result = $gatherer->getNotesByNoteId($noteId);
			$subject = $result[subject];
			$priority = $result[priority];
			$note = $result[note];
		}
?>

<!DOCTYPE html>
<html lang="en">
        <head>
                <LINK REL=StyleSheet HREF="css/bootstrap.min.css" TYPE="text/css">
                <LINK REL=StyleSheet HREF="css/site.css" TYPE="text/css">
        </head>
        <body>
                <div class="container-fluid">
                        <div class="navbar">
                                <div class="navbar-inner">
                                        <a class="brand" href="#">NuVista</a>
                                        <ul class="nav">
                                                <li><a href="summary.php">Health Summary</a></li>
                                                <li><a href="demographics.php">Demographics</a></li>
                                                <li class="active"><a href="progressNotes.php">Progress Notes</a></li>
                                        </ul>
                                </div>
                        </div>
                        <div class="row-fluid">
                                <div class="span4 offset4">
                                        <h1>Progress Note</h1><br>
                                </div>
                                <form action="progressNotes.php" method="POST">
                                        <div class="span8 offset3">
                                                <fieldset>
						<?php if(!isset($_GET['noteId'])) { ?>
                                                        <input type="text" placeholder="Subject" name="subject"><br>
                                                        <textarea name="note" rows="6" cols="20"></textarea><br><br>
                                                        <select name="priority" placeholder="Select a Priority">
                                                                <option value="3">High</option>
                                                                <option value="2">Medium</option>
                                                                <option value="1">Low</option>
                                                        </select><br>
						<?php } else { ?>
							<input type="text" value="<?= $subject ?>">
							<textarea name="note" rows="6" cols="20"><?=$note?></textarea><br><br>
							<select name="priority" placeholder="Select a Priority">
								<option value="3">High</option>
								<option value="2">Medium</option>
								<option value="1">Low</option>
							</select><br>
							<input type="hidden" name="noteid" value="<?=$noteId?>">
						<?php } ?>
                                                        <button type="submit" class="btn">Submit</button>
                                                </fieldset>
                                        </div>
                                </form>
                        </div>
                </div>
        </body>
</html>
