<div id="content-header">
<h1>Offer Preview</h1>
</div>

<div id="content-panel">
	<div class="whitebox" style="width: 500px; float: left;">
	<h1><?=$offer->name;?></h1>
	<ul>
		<?php if($offer->image):?>
			<li><?=$this->html->image("/images/{$offer->image}.jpg");?></li>
		<?php endif;?>
		<li><em>Availability</em>: <?=$offer->availability;?></li>
		<li><em>Starts</em>: <?php echo date('Y-m-d H:i:s', $offer->starts->sec);?></li>
		<li><em>Ends</em>: <?php echo date('Y-m-d H:i:s',$offer->ends->sec);?></li>
	</ul>
	<p style="text-align: justify;"><?php echo nl2br($offer->description);?></p>
	</div>
	<div class="whitebox" style="margin-left: 30px; width: 300px; float:left;">
		<?php if($venue->logo):?>
			<?=$this->html->image("/images/{$venue->logo}.jpg")?>
		<?php endif;?>
		<h3>Location</h3>
		<ul style="list-style: none;">
			<li><?=$venue->name;?></li>
			<li><?=$venue->address;?></li>
		</ul>
	</div>
	<br style="clear: both" />
	<div class="whitebox" style="width: 200px;">
		<?=$this->html->link('Publish', array('Offers::publish', 'id'=>$offer->_id));?>
	</div>
</div>