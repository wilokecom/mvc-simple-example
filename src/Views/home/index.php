<?php
include "src/Views/header.php";
echo "<h1>Homepage</h1>";


?>
    <div id="message"></div>
	<form id="ajaxhandler" class="form ui" action="ajaxhandler" method="POST">
		<div class="field">
			<label>Username</label>
			<input type="text" name="username" placeholder="Username">
		</div>
        <div class="field">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="">
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"/>
        </div>

        <input type="hidden" name="action" value="register" id="action">
		<br>
		<button id="submit" class="ui button" type="submit">Submit</button>
	</form>
<?php
include "src/Views/footer.php";
