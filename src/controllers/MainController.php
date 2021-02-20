<?php

namespace migvitram\xmlgenerator\controllers;

use migvitram\xmlgenerator\XmlGeneratorModule;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class MainController
 * main controller for response with sitemap.xml, atom.xml and rss.xml files
 * @package migvitram\xmlgenerator\controllers
 */
class MainController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'index' => ['get'],
                    //'atom' => ['get'],
                    //'rss' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Method to get the sitemap.xml file
     * return xml response
     */
    public function actionIndex($lang = null)
    {
        $response = Yii::$app->response;

        $pages = XmlGeneratorModule::getInstance()->sitemapInstance;

        $response->format = Response::FORMAT_RAW;
        $response->headers->add('Content-Type', 'text/xml');
        $response->data = $this->renderPartial('sitemapXml', [
            'sitemap' => $pages,
            'languages' => XmlGeneratorModule::getInstance()->languages
        ]);
    }

    /**
     * Method to get the atom.xml file
     * return xml response
     */
    public function actionAtom()
    {
        $response = Yii::$app->response;

        $atomFeed = XmlGeneratorModule::getInstance()->atomInstance;

        $response->format = Response::FORMAT_RAW;
        $response->headers->add('Content-Type', 'text/xml');
        $response->data = $this->renderPartial('atomXml', [
            'feed' => $atomFeed
        ]);
    }

    /**
     * Method to get the rss.xml file
     * return xml response
     */
    public function actionRss($lang = null)
    {
        if ( $lang ) {
            XmlGeneratorModule::getInstance()->resetLanguage($lang);
        }

        $response = Yii::$app->response;

        $rssChannel = XmlGeneratorModule::getInstance()->rssInstance;

        $response->format = Response::FORMAT_RAW;
        $response->headers->add('Content-Type', 'text/xml');
        $response->data = $this->renderPartial('rssXml', [
            'channel' => $rssChannel
        ]);
    }
}
