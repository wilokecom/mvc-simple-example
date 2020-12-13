<?php
include 'src/Views/header.php';

$aUsers = Query::connect()->table('users')->get();
?>
    <h1>Registered Users</h1>
<?php
if (empty($aUsers)) {
	echo "There is no user";
} else {
	?>
    <ul>
		<?php foreach ($aUsers as $aUser) { ?>
            <li>
                #<?php echo $aUser['ID'] . ' ' . $aUser['username']; ?>
                <form action="delete-user" method="post">
                    <input type="hidden" name="id" value="<?php echo $aUser['ID']; ?>">
                    <button class="button red" type="submit">Delete</button>
                </form>
            </li>
		<?php } ?>
    </ul>
	<?php
}
?>
    <hr/>
    <div id="message"></div>
    <form action="" class="ui form" method="post">
        <div class="field">
            <label for="username">Route</label>
            <input type="text" id="route" name="route" value="register">
        </div>

        <div class="field">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="User Name">
        </div>

        <div class="field">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="myemail@gmail.com">
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"/>
        </div>

        <button type="submit" class="ui button green">Submit</button>
    </form>
<?php
include 'src/Views/footer.php';
