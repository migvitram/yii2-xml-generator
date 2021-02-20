<?php

/** @var array $languages */
/** @var stdClass $sitemap */

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<?php /*echo '<?xml-stylesheet type="text/css" href="/css/doc.css"?>' . PHP_EOL */?>
<?php if ( $sitemap ) { ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
<?php foreach ($sitemap->items as $item): ?>
    <url>
        <loc><?= $item->loc ?></loc>
        <lastmod><?= $item->lastmod ?></lastmod>
        <changefreq><?= $item->changefreq ?></changefreq>
        <priority><?= $item->priority ?></priority>
<?php $altSlugs = $item->alternates; foreach ($languages as $language) { ?>
        <xhtml:link rel="alternate" hreflang="<?= $language ?>" href="<?= (!empty($altSlugs) && is_array($altSlugs))
            ? $altSlugs[$language]
            : $altSlugs ?>" />
<?php } ?>
    </url>
<?php endforeach; ?>
</urlset>
<?php } ?>
