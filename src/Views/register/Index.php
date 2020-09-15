<?php
include "src/Views/header.php";?>
<form class="ui form" method="post" action="<?=\mvc_simple_example\core\URL::url('register')?>">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="ui segment">
            <?php echo $_SESSION['error']; ?>
        </div>
    <?php endif; ?>
    <div class="fields three">
        <div class="field">
            <label for="username">username</label>
            <input id="username" type="text" name="username" placeholder="username" required>
        </div>
        <div class="field">
            <label for="password">password</label>
            <input id="password" type="password" name="password" placeholder="password" required>
        </div>
        <div class="field">
            <label for="email">email</label>
            <input id="email" type="email" name="email" placeholder="email" required>
        </div>
    </div>
    <button class="ui button" type="submit" style="background-color: #1aa62a">Submit</button>
</form>
<?php
include "src/Views/footer.php";