<?php
include "src/Views/header.php";
?>
	<form class="ui form" method="post">
		<div class="field">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" placeholder="Name">
		</div>
		<div class="field">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" placeholder="Email">
		</div>
		<div class="field">
			<label for="password">Password</label>
			<input type="password" name="password" id="password" placeholder="Password">
		</div>
		<button class="ui button" type="submit">Submit</button>
	</form>

<?php
include "src/Views/footer.php";
?>