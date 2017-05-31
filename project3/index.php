<html>
<head>
</head>
<body>
	<form method="post">
	 	<input type="submit" name="submit" value="Submit"/>
	</form>
	<?php

		if(isset($_POST['submit'])){

			include('functions.php');
			echo gerarToken();
			//insertUsers();
			//insertMessages();
			//echo selectUsers();
		}
	?>
</body>

</html>
