<div id="content-header">
<h1>Current Deals</h1>
</div>

<div id="content-panel">


<?php if(!count($offers)):?>
	<p class="empty-results">
		Sorry, there are currently no offers.
		<br />
		<br />
		Come Back Soon!
		<br />
		<br />
		~Chowly
	</p>
<?php endif;?>
<ul class="offers">
	<?php foreach($offers as $offer):?>
		<li>
			<h4><?=$this->html->link($offer->name, array('Offers::view', 'id'=> $offer->_id));?></h4>
		</li>
	<?php endforeach;?>
</ul>
</div>