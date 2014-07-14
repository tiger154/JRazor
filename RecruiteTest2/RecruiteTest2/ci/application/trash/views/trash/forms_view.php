<html>
<head>
<title><?=$title;?></title>
</head>
<body>
<h1><?=$title;?></h1>
<table border='1'>
<tr>
<th>Title</th>
<td>Entry</td>
</tr>
<?php foreach($result->result_array() as $entry):?>
<tr>
<th><?=$entry['title'];?></th>
<td><?=$entry['data'];?></td>
</tr>
<?php endforeach;?>
</table>
<?php echo form_open('form/submit'); ?>
<br><br>
Titile<br>
<input type="text" name="Title"><br>
Entry<br>
<input type="text" name="data">
<input type="submit" value="New">
</form>
</body>
</html>


