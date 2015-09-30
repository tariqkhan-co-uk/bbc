<h1>Recipe list</h1>
<p>A list of <?php echo $list->count; ?> recipes; inspiration for your cooking.</p>
<?php if($list->count == 0) { ?>
<p>Sorry, we currently have no recipes for you.</p>
<?php } else { ?>
<ul>
<?php $list->showData(); ?>
</ul>
<?php $list->showPagination(); ?>
<?php } ?>
