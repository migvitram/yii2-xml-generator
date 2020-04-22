Simple xml module for Yii2
==========================
Module for xml files generation on-the-fly (e.g. sitemap.xml)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist migvitram/yii2-xml-generator "*"
```

or add

```
"migvitram/yii2-xml-generator": "@dev"
```

to the require-dev section of your `composer.json` file.


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

Callback methods must generate array of arrays, where every child need to satisfy
that format : 

```php
 [
    ...
    [
        'loc' => Url::base(true) . 'your/pages/url',
        'lastmod' => '2016-10-10', // date of page modification in format 'Y-m-d'
        'changefreq' => migvitram\xmlgenerator\models\SitemapSchema::CHANG_FREQ_MONTH, // frequency of changing 
        'priority' => 0.8,  // priority in double type number
    ],
    ...
 ]
```

, according to [sitemap protocol](https://www.sitemaps.org/protocol.html).

For example, method `getPagesForSitemap` in Page model can be looks like:

```php
 namespace your\app\namespace;
 
 use yii\base\Model;
 use yii\helpers\Url;
 use migvitram\xmlgenerator\models\SitemapSchema;
 
 class Page extends Model
 {
     /**
      * @return array
      */
     public static function getPagesForSitemap()
     {
         return $pages = [
             [
                 'loc' => Url::base(true),
                 'lastmod' => '2016-10-10',
                 'changefreq' => SitemapSchema::CHANG_FREQ_DAY,
                 'priority' => 0.8,
             ],
             [
                 'loc' => Url::base(true).'/site/about',
                 'lastmod' => '2016-10-10',
                 'changefreq' => SitemapSchema::CHANG_FREQ_YEAR,
                 'priority' => 0.8,
             ],
             [
                 'loc' => Url::base(true).'/site/contact',
                 'lastmod' => '2016-10-10',
                 'changefreq' => SitemapSchema::CHANG_FREQ_MONTH,
                 'priority' => 0.8,
             ],
             [
                 'loc' => Url::base(true).'/site/news',
                 'lastmod' => '2016-10-10',
                 'changefreq' => 'monthly',
                 'priority' => 0.8,
             ],
         ];
     }
 }
```
