<?php loadView('header'); ?>
<form class="ui form" method="post">
	<div class="field">
		<label for="fName">First Name</label>
		<input type="text" name="first-name" id="fName" placeholder="First Name">
	</div>
	<div class="field">
		<label for="lName">Last Name</label>
		<input type="text" name="last-name" id="lName" placeholder="Last Name">
	</div>
    <div class="field">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Email">
    </div>
    <div class="field">
        <label for="pass">Password</label>
        <input type="password" name="password" id="pass" placeholder="Password">
    </div>
	<button class="ui button" type="submit">Submit</button>
</form>
<?php loadView('footer'); ?>