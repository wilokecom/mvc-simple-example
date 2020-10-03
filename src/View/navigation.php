<div class="ui grid">
    <div class="four wide column">
        <div class="ui vertical fluid tabular menu">
			<?php $aNavigation = include "config/app.php";
			foreach ($aNavigation['Navigation'] as $key => $val) :
				?>
                <a class="<?php echo isNavigation($key); ?> item" href="<?php echo $key; ?>">
					<?php echo $val; ?>
                </a>
			<?php endforeach; ?>
        </div>
    </div>
    <div class="twelve wide stretched column">
        <div class="ui segment">

