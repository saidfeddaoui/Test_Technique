<ul class='list-group'>
    <?php foreach ($listConnected as $value):?>
    <li class='list-group-item' style="margin-bottom: 10px;"><?php echo $value['pseudo'];?>
    <p class="connected"></p>
    </li>
     <?php endforeach; ?>
</ul>