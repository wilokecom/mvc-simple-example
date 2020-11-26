<div class="ui pointing menu">
	<?php
	$aNavigation = include "configs/navigation.php";
	foreach ($aNavigation as $navigationKey => $navigationValue):
		?>
        <a class="<?php echo isMatchedRoute($navigationKey) ? 'active' : ''; ?> item" href="<?php echo $navigationKey; ?>">
			<?php echo $navigationValue; ?>
        </a>
	<?php endforeach; ?>
    <div class="right menu">
        <div class="item">
            <div class="ui transparent icon input">
                <input type="text" placeholder="Search...">
                <i class="search link icon"></i>
            </div>
        </div>
    </div>
</div>
