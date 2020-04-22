<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <title><?= $main->title ?></title>
    <link href="<?= $main->link ?>"/>
    <updated><?= $main->updated ?></updated>
    <author>
        <name><?= $main->author ?></name>
    </author>
    <id><?= $main->id ?></id>

    <?php foreach ($items as $item): ?>
    <entry>
        <title><?= $item->title?></title>
        <link href="<?= $item->link?>"/>
        <id><?= $item->id ?></id>
        <updated><?= $item->updated?></updated>
        <summary><?= $item->summary?></summary>
    </entry>
    <?php endforeach; ?>
</feed>