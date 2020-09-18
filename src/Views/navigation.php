<div class="ui pointing menu">
	<?php
	$aNavigation = include "config/navigation.php";
	foreach ($aNavigation as $navigationKey => $navigationValue):
		?>
        <a class="<?php echo isMatchedRoute($navigationKey) ? 'active' : ''; ?> item" href="?route=<?php echo
		$navigationKey; ?>">
			<?php echo $navigationValue; ?>
        </a>
	<?php endforeach; ?>
</div>
