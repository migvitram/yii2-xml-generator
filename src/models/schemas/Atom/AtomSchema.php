<?php

namespace migvitram\xmlgenerator\models\schemas\Atom;

use yii\base\Model;

/**
 * Class SitemapSchema
 * @package migvitram\xmlgenerator\models
 */
class AtomSchema extends Model
{
    /** Feed section required fields */
    const MAIN_TITLE_FIELD      = 'title'; // Site name
    const MAIN_LINK_FIELD       = 'link'; //  <link href="http://example.org/"/>
    const MAIN_UPDATED_FIELD    = 'updated'; //
    const MAIN_AUTHOR_FIELD     = 'author';
    const MAIN_ID_FIELD         = 'id'; // urn:uuid:60a76c80-d399-11d9-b93C-0003939e0af6

    /** Fields of entry sections */
    const ENTRY_TITLE_FIELD     = 'title' ;
    const ENTRY_ID_FIELD        = 'id' ;  // urn:uuid:1225c695-cfb8-4ebb-aaaa-80da344efa6a
    const ENTRY_LINK_FIELD      = 'link ' ;
    const ENTRY_UPDATE_FIELD    = 'updated' ;
    const ENTRY_SUMMARY_FIELD   = 'summary' ;

    /** Required feed fields */
    const REQUIRED_FEED_FIELDS  = [
        self::MAIN_ID_FIELD, self::MAIN_TITLE_FIELD, self::MAIN_UPDATED_FIELD
    ];

    /** Recommended feed fields */
    const RECOMENDED_FEED_FIELDS = [
        self::MAIN_AUTHOR_FIELD, self::MAIN_LINK_FIELD
    ];

    /**
     * @param array $params
     * @return AtomFeed
     */
    public static function initiateFeed( array $params )
    {
        return new AtomFeed( (object)$params );
    }

    /**
     * Method to get date in the '2020-00-00T12:00Z' format
     * @param $dateTime
     * @param $format
     * @param null $timeZone
     * @return string
     */
    public static function formatTheDateField( $dateTime, $format = DATE_ATOM, $timeZone = null )
    {
        if ( is_int($dateTime) ) {
            return date($format, $dateTime);
        }

        return '';
    }
}