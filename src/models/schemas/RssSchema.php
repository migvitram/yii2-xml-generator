<?php

namespace migvitram\xmlgenerator\models\schemas;

use yii\base\Model;

/**
 * Class SitemapSchema
 * @package migvitram\xmlgenerator\models
 */
class RssSchema extends Model
{
    protected static $channel;

    /** Feed section required fields */
    const TITLE_FIELD      = 'title'; // Title
    const LINK_FIELD       = 'link'; //  http://example.org/
    const DESCRIPTION_FIELD = 'description'; // short description

    /** Required channel fields */
    const REQUIRED_CHANNEL_FIELDS = [
        self::TITLE_FIELD, self::LINK_FIELD, self::DESCRIPTION_FIELD
    ];

    /** Other required item fields */
    const ITEM_AUTHOR_FIELD     = 'author';
    const ITEM_CATEGORY_FIELD   = 'category';
    const ITEM_COMMENTS_FIELD   = 'comments';
    const ITEM_ENCLOSURE_FIELD  = 'enclosure';
    const ITEM_GUID_FIELD       = 'guid';
    const ITEM_PUBDATE_FIELD    = 'pubDate';
    const ITEM_SOURCE_FIELD     = 'source';

    /** Required item fields */
    const REQUIRED_ITEM_FIELDS = [
        self::TITLE_FIELD, self::LINK_FIELD, self::DESCRIPTION_FIELD,
        self::ITEM_AUTHOR_FIELD, self::ITEM_CATEGORY_FIELD, self::ITEM_COMMENTS_FIELD, self::ITEM_ENCLOSURE_FIELD,
        self::ITEM_GUID_FIELD, self::ITEM_PUBDATE_FIELD, self::ITEM_SOURCE_FIELD,
    ];

    /** Optional rss channel fields */
    const OPTIONAL_CHANNEL_FIELDS = [
        'language',
        'copyright',
        'managingEditor',
        'webMaster',
        'pubDate',
        'lastBuildDate',
        'category',
        'generator',
        'docs',
        'cloud',
        'ttl',
        'image',
        'textInput',
        'skipHours',
        'skipDays',
    ];

    /** Optional rss item fields */
    const OPTIONAL_ITEM_FIELDS = [
        '',
        '',
        '',
    ];

    /**
     * Initiate the Rss channel class instance
     * @param $params
     * @return RssChannel
     */
    public static function initiateChannel($params)
    {
        return self::$channel = new RssChannel( (object)$params );
    }

    /**
     * @return array
     */
    public static function getDefaultMainParams()
    {
        return [
            self::TITLE_FIELD      => '',
            self::LINK_FIELD       => '',
            self::DESCRIPTION_FIELD => '',
        ];
    }

    /**
     * @param $dateTime
     * @param string $format
     * @param null $timeZone
     * @return string
     */
    public static function formatPubDate( $dateTime, $format = DATE_RSS, $timeZone = null )
    {
        // Sun, 29 Sep 2002 19:59:01 GMT
        if ( is_int($dateTime) ) {
            return date($format, $dateTime);
        }

        return '';
    }
}