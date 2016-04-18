<div class="jumbotron">
    <h1>HOOOOOME</h1>
</div>
<div class="page-header">
    <h2><?=$prenom?></h2>
</div>
<ul class="list-group">
    <?php foreach ($pageList as $onePage) :?>
        <li class="list-group-item">
            <?=$onePage->h1?> <strong><?=$onePage->body?></strong>
        </li>
    <?php endforeach;?>
</ul>
