<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<feed xmlns="http://www.w3.org/2005/Atom">
    <?php if ( $feed ) {?>
    <title><?= $feed->title ?></title>
    <link href="<?= $feed->link ?>"/>
    <updated><?= $feed->updated ?></updated>
    <author>
        <name><?= $feed->author ?></name>
    </author>
    <id><?= $feed->id ?></id>

    <?php foreach ($feed->items as $item): ?>
    <entry>
        <title><?= $item->title?></title>
        <link href="<?= $item->link?>"/>
        <id><?= $item->id ?></id>
        <updated><?= $item->updated?></updated>
        <summary><?= $item->summary?></summary>
    </entry>
    <?php endforeach; ?>
    <?php } ?>
</feed>