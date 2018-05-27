<?php foreach ($messageList as $value):?>
<div class="list-group">
  <a href="#" class="list-group-item list-group-item-action">
    <h5 class="list-group-item-heading"> <?php echo '<b>'.$value['dateMessage'].'</b>' ?> - <span style="color:#337ab7"><?php echo $value['pseudo'] ?><span></h5>
    <p class="list-group-item-text"> <?php echo $value['message'] ?></p>
  </a>
</div>
<?php endforeach;
