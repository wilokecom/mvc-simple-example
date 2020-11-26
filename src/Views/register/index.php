<?php
include 'src/Views/header.php';
?>
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
            <input type="password" id="password" name="password" />
        </div>

        <button type="submit" class="ui button green">Submit</button>
    </form>
<?php
include 'src/Views/footer.php';
