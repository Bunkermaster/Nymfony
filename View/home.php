<?php /** @var \Model\Entity\Page $onePage */?>
<?php /** @var array $pageList */?>
<div class="jumbotron">
    <h1>HOOOOOME</h1>
</div>
<div class="page-header">
    <h2><?=$prenom?></h2>
</div>
<ul class="list-group">
    <?php foreach ($pageList as $onePage) :?>
        <li class="list-group-item">
            <?=$onePage->getH1()?> <strong><?=$onePage->getBody()?></strong>
        </li>
    <?php endforeach;?>
</ul>
