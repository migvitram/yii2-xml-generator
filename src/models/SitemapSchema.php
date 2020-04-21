<?php

namespace migvitram\xmlgenerator\models;

use yii\base\Model;

/**
 * Class SitemapSchema
 * @package migvitram\xmlgenerator\models
 */
class SitemapSchema extends Model
{
    /** Change frequency */
    const CHANG_FREQ_ALWAYS = 'always';
    const CHANG_FREQ_HOUR   = 'hourly';
    const CHANG_FREQ_DAY    = 'daily';
    const CHANG_FREQ_WEEK   = 'weekly';
    const CHANG_FREQ_MONTH  = 'monthly';
    const CHANG_FREQ_YEAR   = 'yearly';
    const CHANG_FREQ_NEVER  = 'never';
    
    
}