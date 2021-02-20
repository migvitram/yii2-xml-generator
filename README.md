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
"migvitram/yii2-xml-generator": "*"
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
        'languages' => ['en', 'fr', 'de'],  // not required
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
 use migvitram\xmlgenerator\models\schemas\Sitemap\SitemapSchema;
 
 class Page extends Model
 {
     /**
      * @return array
      */
     public static function getPagesForSitemap()
     {
         return [
             [
                 'loc' => Url::base(true),
                 'lastmod' => '2016-10-10',
                 'changefreq' => SitemapSchema::CHANG_FREQ_DAY,
                 'priority' => 0.8,
                 'alternates' => [
                    'en' => 'https://your.domain/en/page.url',
                    'fr' => 'https://your.domain/fr/page.url',
                 ],
             ],
             [
                 'loc' => Url::base(true).'/site/about',
                 'lastmod' => '2016-10-10',
                 'changefreq' => SitemapSchema::CHANG_FREQ_YEAR,
                 'priority' => 0.8,
                 'alternates' => [
                    'en' => 'https://your.domain/en/page.url',
                    'fr' => 'https://your.domain/fr/page.url',
                 ],
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
                 'alternates' => [
                    'en' => 'https://your.domain/en/page.url',
                    'fr' => 'https://your.domain/fr/page.url',
                 ],
             ],
         ];
     }
 }
```

If you are going to make multilingual web-site, then pay attention to `alternates` property

Method to get data for rss.xml must return array with next required fields :

```php

use migvitram\xmlgenerator\models\schemas\Rss\RssSchema;

class Page extends Model
 {
     /**
      * @return array
      */
     public static function getItemsForRss()
     {
         // gather all needed news
         
         return [
             RssSchema::TITLE_FIELD    => 'some title',  // RssSchema constant for field name can be used
             RssSchema::LINK_FIELD    => 'soem link /',
             RssSchema::DESCRIPTION_FIELD    => 'description here',
             'image' => [
                 'title' => 'aodfijoisdjf IMAGE',
                 'link' => Url::base(true).'/aodfijoisdjf987',
                 'url' => 'aodifj/asodifj.sod'
             ],
             'language' => 'ru',
             'items' => [
                 [
                     RssSchema::TITLE_FIELD => '1 title of entry',
                     RssSchema::LINK_FIELD => 'http://example.org/2003/12/13/atom03',
                     RssSchema::DESCRIPTION_FIELD => 'asdf joiasdjf oiajsdfa9s8dhf ajksdnf admfa suidhf9 ashd9f8h',
                     'someOption' => 'asdfoij'
                 ],
                 [
                     RssSchema::TITLE_FIELD  => '2 title of entry',
                     RssSchema::LINK_FIELD  => 'http://example.org/2003/12/13/atom03',
                     RssSchema::DESCRIPTION_FIELD  => 'asdf joiasdjf oiajsdfa9s8dhf ajksdnf admfa suidhf9 ashd9f8h',
                     'author' => 'ADFd Adfid',
                 ],
                 [
                     RssSchema::TITLE_FIELD  => '3 title of entry',
                     RssSchema::LINK_FIELD  => 'http://example.org/2003/12/13/atom03',
                     RssSchema::DESCRIPTION_FIELD  => 'asdf joiasdjf oiajsdfa9s8dhf ajksdnf admfa suidhf9 ashd9f8h',
                     'comments' => 'aodsfijoasidfjoij/aoidjsfoijadf/aoidsjf',
                 ],
             ],
         ];
     }
 }

```

items and channel sections can have optional fields, according to  rss [documentation](https://validator.w3.org/feed/docs/rss2.html)

Method to get data for atom.xml must return array with Atom feed required fields and required `items` array :

```php

use migvitram\xmlgenerator\models\schemas\Atom\AtomSchema;

 class Page extends Model
 {
     /**
      * @return array
      */
     public static function getItemsForAtom()
     {
         // gather all needed news
         
         return [
             'title'     => 'Feed title',
             'link'      => 'your/site/url',
             'updated'   => '2020-04-10T11:50Z',
             'author'    => 'John Doe',
             'id'    => 'urn:uuid:60a76c80-d399-11d9-b93C-0003939e0af6 or some your own',
             'items' => [
                 [
                     AtomSchema::ENTRY_TITLE_FIELD  => '1 title of entry',  // AtomSchema constant for field name can be used 
                     AtomSchema::ENTRY_LINK_FIELD  => 'http://example.org/2003/12/13/atom01',
                     AtomSchema::ENTRY_UPDATE_FIELD  => '2016-10-10T6:50Z',
                     AtomSchema::ENTRY_SUMMARY_FIELD  => 'Some summary about article',
                     AtomSchema::ENTRY_ID_FIELD        => 'urn:uuid:60a76c80-d399-11d9-b93C-0003939e0af6 or some your own',
                 ],
                 [
                     'title' => '2 title of entry',
                     'link' => 'http://example.org/2003/12/13/atom02',
                     'updated' => '2016-10-10T6:50Z',
                     'summary' => 'Some summary about article',
                     'id'    => 'urn:uuid:60a76c80-d399-11d9-b93C-0003939e0af6 or some your own',
                 ],
                 [
                     'title' => '3 title of entry',
                     'link' => 'http://example.org/2003/12/13/atom03',
                     'updated' => '2016-10-10T6:50Z',
                     'summary' => 'Some summary about article',
                     'id'    => 'urn:uuid:60a76c80-d399-11d9-b93C-0003939e0af6 or some your own',
                 ],
             ],
         ];
     }
 }
```

, according to atom.xml [documentation](https://validator.w3.org/feed/docs/atom.html#sampleFeed). 
