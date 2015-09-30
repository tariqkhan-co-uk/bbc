<h1>Starred recipes</h1>
<?php if(empty($star->json)) { ?>
	<p>Sorry, you don't currently have any starred recipes, get started by starring recipes you like.</p>
<?php } else { ?>
<ul>
	<?php $star->showData(); ?>
</ul>
<?php } ?>
