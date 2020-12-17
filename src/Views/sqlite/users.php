<?php

use Basic\Database\Sqlite;

include "src/Views/header.php";
echo "<h1>Users</h1>";
?>
<?php


$sqliteQuery = Sqlite::connect()->table('users')->get();
$query = new \Basic\Database\Query($sqliteQuery);
global $post;
if ($query->havePost()) {
	?>
    <ul>
		<?php
		while ($query->havePost()) {
			$query->thePost();
			?>
            <li>ID: <?= $post->ID; ?>. Username: <?= $post->username; ?></li>
			<?php
		}
		?>
    </ul>
	<?php
}
?>
    <div id="message"></div>
    <form id="ajaxhandler" class="form ui" action="adduser" method="POST">
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
        <br>
        <button id="submit" class="ui button" type="submit">Submit</button>
    </form>
<?php
include "src/Views/footer.php";