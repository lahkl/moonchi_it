<div class="buy-progress">
	<div class="line-short line-active">
	</div>
	<div class="buy-progress-step buy-step-one">
		<div class="buy-step-circle active">
			1
		</div>
		<span class="text-active">
			<?php echo __('Košarica', 'storefront'); ?>
		</span>
	</div>
    <?php
        if ( is_checkout() ) {
    ?>
    <div class="line line-active"></div>
    <?php } else { ?>
            <div class="line"></div>
    <?php } ?>
	<div class="buy-progress-step buy-step-one">
        <?php
        if ( is_checkout() ) {
            ?>
            <div class="buy-step-circle active">2</div>
        <?php } else { ?>
            <div class="buy-step-circle">2</div>
        <?php } ?>

        <?php
        if ( is_checkout() ) {
            ?>
            <span class="text-active"><?php echo __('Naročilo', 'storefront'); ?></span>
        <?php } else { ?>
            <span><?php echo __('Naročilo', 'storefront'); ?></span>
        <?php } ?>

	</div>
		<?php
		if( is_wc_endpoint_url( "order-received" ) ) {
		?>
	<div class="line line-active"></div>
		<?php } else { ?>
	<div class="line"></div>
		<?php } ?>
	<div class="buy-progress-step buy-step-one">
		<?php
			if( is_wc_endpoint_url( "order-received" ) ) {
		?>
			<div class="buy-step-circle active">3</div>
		<?php } else { ?>
			<div class="buy-step-circle">3</div>
		<?php } ?>
		<?php
			if( is_wc_endpoint_url( "order-received" ) ) {
		?>
			<span class="text-active"><?php echo __('Zaključi nakup', 'storefront'); ?></span>
		<?php } else { ?>
			<span><?php echo __('Zaključi nakup', 'storefront'); ?></span>
		<?php } ?>
	</div>
		<?php
			if( is_wc_endpoint_url( "order-received" ) ) {
		?>
			<div class="line-short line-active"></div>
        <?php } else { ?>
			<div class="line-short">
        <?php } ?>
	</div>
</div>
