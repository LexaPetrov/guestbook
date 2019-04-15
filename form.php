<?php
require_once("config.php");
if (!empty($_POST['comment'])){
	$stmt = $dbConn->prepare('INSERT INTO comms(`name`, `comment`) VALUES (:name, :comment)');
	$stmt->execute(array('name' => $_POST['name'], 'comment' => $_POST['comment']));
}
$stmt = $dbConn->prepare('SELECT * FROM comms ORDER BY id DESC');
$stmt->execute();
$comments = $stmt->fetchAll();
$date =  date("m/d/Y h:i:s a", time());
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Комментарии</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
</head>
<body style="text-align: center;">
	<div class="container">
		<br>
		<div id="comments-header">
		<h5>Гостевая книга</h5>
	</div>
	<div id="comments-form">
		<form method="POST">
			<div>
				<input  class="form-control" name="name" id="" placeholder="введите ваше имя..." required=""></input>
				<div>
					<br>
					<textarea class="form-control" name="comment" id="" cols="30" rows="5" placeholder="комментарий..." required=""></textarea>
				</div>
			</div>
			<div>
				<br>
				<input type="submit" name="submit" value="Сохранить" class="btn btn-info">
			</div>
		</form>
		
	</div>
	<div class="search-form">
		<form action="form.php" method="get">
			<br>
			<input type="text" class="form-control" name="search" placeholder="поиск.." />
			<br>
			<input type="submit" value="найти" class="btn btn-info" />
			<br>
		</form>
		<p align="center">
			<?php
			if(isset($_GET["search"]))
			{
				echo "Результаты поиска для: ".$_GET["search"];
				echo "<br /><i>Нет результатов </i>";
			}
			?>
		</p>
	</div>
	<div id="comments-panel" >
		<h6 style="color: #abcdef">Комментарии:</h6>
		<div >
			<?php foreach($comments as $comment): ?>
			<p style="border: .5px dotted gray;" <?php echo 'style="font-weight:bold;"'; ?>>
				<p style="font-weight: bold; margin-bottom: 0px;"><?php echo  $comment['name'];?> <span class="comment-date"> (<?php echo $comment['created_at']; ?>)</span> :</p>
				"<?php echo  $comment['comment']; ?>"
			</p>
		<?php endforeach; ?>
		</div>
		
	</div>
	</div>
</body>
</html>