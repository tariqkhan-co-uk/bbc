<h1>Filter recipes</h1>
<form action="?page=filter" method="post">
	<?php if($filter->error) { ?>
	<h2>Error</h2>
	<p>You have an error in your form.</p>
	<?php } ?>
	<fieldset>
		<legend class="access">Filter data</legend>
		<ol>
			<li>
				<label for="name">Name</label>
				<input type="text" name="name" id="name" />
				<?php $filter->msg('name'); ?>
			</li>
			<li>
				<label for="ingredients">Ingredient</label>
				<input type="text" name="ingredients" id="ingredients" />
				<?php $filter->msg('ingredients'); ?>
			</li>
			<li>
				<label for="cookingtime">Cooking Time</label>
				<select id="cookingtime" name="cookingtime">
					<option value="" selected="selected">Please select cooking time</option>
					<option value="5">5 minutes</option>
					<option value="10">10 minutes</option>
					<option value="15">15 minutes</option>
					<option value="20">20 minutes</option>
					<option value="25">25 minutes</option>
					<option value="30">30 minutes</option>
					<option value="35">35 minutes</option>
					<option value="40">40 minutes</option>
					<option value="45">45 minutes</option>
					<option value="50">50 minutes</option>
					<option value="55">55 minutes</option>
					<option value="60">60 minutes</option>
				</select>
			</li>
		</ol>
		<input type="submit" name="filter" value="Filter" class="btn" />
	</fieldset>
</form>
<?php if(!empty($_POST['filter']) && !$filter->error) { ?>
<div id="filterresults" class="filterresults">
	<section>
		<h2>Filter results</h2>
		<?php if($filter->result) { ?>
		<ul>
			<?php $filter->showData(); ?>
		</ul>
		<?php } else { ?>
		<p>Sorry, nothing matched your filter term.</p>
		<?php } ?>
	</section>
</div>
<?php } ?>
