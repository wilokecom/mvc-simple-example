<?php use MVC\Model\UserModel;

loadView('header'); ?>

    <table class="ui celled table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Pass</th>
            <th>Date</th>
            <th>Action</th>
            <th>Change password</th>
            <th>Change email</th>
        </tr>
        </thead>
        <tbody>
		<?php
        foreach ($aData as $key => $val): ?>
            <tr>
				<?php foreach ($val as $valueSheet): ?>
                    <td><?php echo $valueSheet; ?></td>
				<?php endforeach; ?>
                <td>
                    <form action="/user/delete" method="post">
                        <input type="hidden" name="uid" value="<?php echo $val['user_id']; ?>">
                        <button class="ui red button">Delete</button>
                    </form>
                </td>
                <td>
                    <form action="/user/change-password" method="post">
                        <input type="hidden" name="uid" value="<?php echo $val['user_id']; ?>">
                        <input type="text" name="newPass" value="">
                        <button class="ui blue button">Change</button>
                    </form>
                </td>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
<?php loadView('footer'); ?>