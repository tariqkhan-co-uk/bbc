<?php if($item->error) { ?>
<h1>Error</h1>
<p>Sorry, this recipe doesn't exist or may have been removed.</p>
<?php } else { ?>
<h1><?php echo $item->name; ?></h1>
<?php if($item->image) { ?>
<img src="<?php echo $item->image; ?>" alt="Image of <?php echo $item->name; ?>" />
<?php } ?>
<p><em>Cooking time: <?php echo $item->cookingtime; ?></em></p>
<p>Ingredients:</p>
<ul>
	<?php echo $item->ingredients; ?>
</ul>
<p>
	<?php if(array_key_exists((int)$item->id, $star->json)) { ?>
		<a href="?page=item&amp;id=<?php echo $item->id; ?>&amp;unstar=<?php echo $item->id; ?>"><img src="images/star.png" alt="" /><br />Unstar this recipe</a>
	<?php } else { ?>
		<a href="?page=item&amp;id=<?php echo $item->id; ?>&amp;star=<?php echo $item->id; ?>"><img src="images/unstar.png" alt="" /><br />Star this recipe</a>
	<?php } ?>
</p>
<?php } ?>
