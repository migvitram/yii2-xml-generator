Simple xml module for Yii2
==========================
to generate xml files on-the-fly

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist migvitram/yii2-xml-generator "*"
```

or add

```
"migvitram/yii2-xml-generator": "*"
```

to the require section of your `composer.json` file.


Usage
-----

After installation, modify the web.php config file, modules section:

```php
 'modules' => [
    ...
    'xmlGenerator' => [
        'class' => 'migvitram\xmlgenerator\XmlGeneratorModule',
        'pages' => ['\app\models\Page', 'getPagesForSitemap'],
        'atom' => ['\app\models\Page', 'getItemsForAtom'],
        'rss' => ['\app\models\Page', 'getItemsForRss'],
    ]
 ]
```

, where can be passed callback function to retrieve the array of items for
sitemap.xml, atom.xml and rss.xml files.
