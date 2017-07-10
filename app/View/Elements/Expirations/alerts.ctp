<?php
    if (!empty($alerts)) :
?>

	<?php foreach ($alerts as $alert) : ?>
		<?php if ($alert['Expiration']['type'] == 'now') : ?>
			<div id="alert-<?php echo $alert['Expiration']['id'];?>" class="alert alert-dismissible alert-danger">
				Hoy vence <?php echo $alert['Expiration']['description']; ?>
				<span style="float: right; cursor: pointer;" class="close-alert" id="<?php echo $alert['Expiration']['id'];?>">Cerrar</span>
			</div>
		<?php endif; ?>		
	<?php endforeach;?>
	
	<?php foreach ($alerts as $alert) : ?>
		<?php if ($alert['Expiration']['type'] == 'one') : ?>
			<div id="alert-<?php echo $alert['Expiration']['id'];?>" class="alert alert-dismissible alert-warning">
				Mañana vence <?php echo $alert['Expiration']['description']; ?>
				<span style="float: right; cursor: pointer;" class="close-alert" id="<?php echo $alert['Expiration']['id'];?>">Cerrar</span>
			</div>
		<?php endif; ?>		
	<?php endforeach;?>	
	
	<?php foreach ($alerts as $alert) : ?>
		<?php if ($alert['Expiration']['type'] == 'three') : ?>
			<div id="alert-<?php echo $alert['Expiration']['id'];?>" class="alert alert-dismissible alert-info">
				En tres días vence <?php echo $alert['Expiration']['description']; ?>
				<span style="float: right; cursor: pointer;" class="close-alert" id="<?php echo $alert['Expiration']['id'];?>">Cerrar</span>
			</div>
		<?php endif; ?>		
	<?php endforeach;?>		

<?php
        
    endif;
?>
