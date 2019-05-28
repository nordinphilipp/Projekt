	<?php
		include('include/bootstrap.php');
		include('include/views/login.php');		
	?> 
			<!-- Footer -->
	<html>
		<body>
			<div class="col-12 red darken-3" style="height: 3vh"></div>
			<?php
				//inkluderar process för att logga in vid submit
				include('include/process/login_process.php');
			?>
		</body>
	</html>
