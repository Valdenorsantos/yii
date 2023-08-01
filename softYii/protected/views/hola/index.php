


<h1> Ola teste de software <?php echo $estudo; ?></h1>

<?php foreach($model as $data): ?>
<h1><?php echo $data->username; ?></h1>
<h1><?php echo $data->password; ?></h1>
<h1><?php echo $data->email; ?></h1>

<?php endforeach ?>
