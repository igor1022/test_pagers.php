<?php

?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>content form</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>


<div style="border: 1px solid black;">
	<div id="add_content" style="margin: 5px 0 20px 0; padding: 5px 0 20px 10px;">
		<h1 class="content_title" name='title_add'>Create a content!</h1>
		<form method="post" id="form_add">

			<input type="text" name="name" id="name" placeholder="Name/Nickname">
			<input type="email" name="email" id="email" placeholder="E-mail" required>
			<br>
			<br>
			<textarea name="content" id="content" rows="8" cols="45" placeholder="Enter your content..." style="display: block;" required></textarea> <br>

			<input type="button" name="send" id="send" value="Send"  style="cursor:pointer;">

			<input type="button" name="cancel" id="cancel_load" value="Cansel"  style="display:none; cursor:pointer;">
			<br>
			<br><br>
			<div id="errorMess"></div>
		</form>
	</div>
</div>

<h1>content</h1>

<div id="content_all">
	<ul>
		<?php if (count($content) === 0) : ?>

		<p>Add content<p>

			<?php else: ?>
			<?php foreach ($content as $content): ?>

			<div style="border: 1px solid blue; margin: 5px 0 20px 0; padding: 5px 0 20px 5px;">
				<div>
		<h3><?php echo $content["name"]?></h3>
</div>
<div>
	<p><?php echo $content["content"]?></p>
</div>
<div>
	<p><strong><?php echo $content["created_at"]?></strong></p>
</div>
</div>

<?php endforeach; ?>
<?php endif; ?>

</ul>
</div>
<?= $pager->links('default', 'default_my') ?>

<script src="<?php echo base_url();?>/js/form.js" charset="utf-8"></script>
</body>
</html>