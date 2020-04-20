<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL ?>
<?php /*echo '<?xml-stylesheet type="text/css" href="/css/doc.css"?>' . PHP_EOL */?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($items as $item): ?>
    <url>
        <loc><?= $item->loc ?></loc>
        <lastmod><?= $item->lastmod ?></lastmod>
        <changefreq><?= $item->changefreq ?></changefreq>
        <priority><?= $item->priority ?></priority>
    </url>
<?php endforeach; ?>
</urlset>