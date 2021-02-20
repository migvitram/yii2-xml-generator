<?php

namespace migvitram\xmlgenerator\models\schemas\Sitemap;

use yii\base\Model;

/**
 * Class SitemapSchema
 * @package migvitram\xmlgenerator\models
 */
class SitemapSchema extends Model
{
    /** Change frequency variables for sitemap.xml <changefreq> section */
    const CHANG_FREQ_ALWAYS = 'always';
    const CHANG_FREQ_HOUR   = 'hourly';
    const CHANG_FREQ_DAY    = 'daily';
    const CHANG_FREQ_WEEK   = 'weekly';
    const CHANG_FREQ_MONTH  = 'monthly';
    const CHANG_FREQ_YEAR   = 'yearly';
    const CHANG_FREQ_NEVER  = 'never';

    /** Fields of link */
    const LOCATION_FIELD    = 'loc' ;
    const LAST_MODIFY_FIELD = 'lastmod' ;
    const CHANGE_FREQUENCY_FIELD = 'changefreq' ;
    const PRIORITY_FIELD    = 'priority' ;
    const ALTERNATES        = 'alternates' ;

    /**
     * @param array $params
     * @return SitemapXml
     */
    public static function initiateSitemapXmlInstance( array $params )
    {
        return new SitemapXml( (object)$params );
    }

}