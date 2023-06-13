<div class="wrapper-1">
<div>
	<?php 
	$sender=$address=$message="";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$sender = test_input($_POST["sender"]);
			$address = test_input($_POST["address"]);
			$message = test_input($_POST["message"]);
		}
		function test_input($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
		<label for="sender" class="form-header"> Name:</label>
		<input type="text" name="sender" size="30">
		<label for="address" class="form-header">E-mail Address:*</label>
		<input type="email" name="address" size="40" required>
		<label for="message" class="form-header">Message:*</label>
		<textarea name="message" type="text" rows="10" cols="30" required></textarea>
		<input type="submit" value="Submit">
	</form>
</div>	
