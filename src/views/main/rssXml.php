<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<rss version="2.0">
    <?php if ( $channel ) { ?>
    <channel>
        <title><?= $channel->title ?></title>
        <link><?= $channel->link ?></link>
        <description><?= $channel->description ?></description>
        <?php if ( $channel->image ) { ?>
        <image>
            <url><?= $channel->image->url ?></url>
            <title><?= $channel->image->title ?></title>
            <link><?= $channel->image->link ?></link>
        </image>
        <?php } ?>

        <?php if ( $channel->hasOptionalProperties() ) {
            foreach ($channel->getOptionalPropertiesNames() as $key => $propertyName) { ?>
        <<?=$propertyName?>><?= $channel->{$propertyName} ?></<?=$propertyName?>>
        <?php } } ?>

        <?php foreach ($channel->items as $item): ?>
        <item>
            <title><?= $item->title ?></title>
            <link><?= $item->link ?></link>
            <description><?= $item->description ?></description>
            <?php if ( $item->hasOptionalProperties() ) {
                foreach ($item->getOptionalPropertiesNames() as $key => $propertyName) { ?>
            <<?=$propertyName?>><?= $item->{$propertyName} ?></<?=$propertyName?>>
            <?php } } ?>
        </item>
        <?php endforeach; ?>

    </channel>
    <?php } ?>
</rss>