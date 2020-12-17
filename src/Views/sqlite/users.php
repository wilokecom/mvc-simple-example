<?php

use Basic\Database\SqliteQuery;

include "src/Views/header.php";
echo "<h1>Users</h1>";
?>
<?php


$sqliteQuery = SqliteQuery::connect()->table('users')->get();
$query = new \Basic\Database\Query($sqliteQuery);
global $post;
if ($query->havePost()) {
	?>
    <ul>
		<?php
		while ($query->havePost()) {
			$query->thePost();
			?>
            <li>
                ID: <?= $post->ID; ?>. Username: <?= $post->username; ?>
                <form action="deleteuser" method="post">
                    <input type="hidden" name="ID" value="<?= $post->ID; ?>">
                    <button class="button red" type="submit">Delete</button>
                </form>
            </li>
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
