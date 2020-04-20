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
 * main controller for response with simemap.xml, atom.xml and rss.xml files
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
                    //'logout' => ['post'],
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
    public function actionIndex()
    {
        $response = Yii::$app->response;

        $pages = XmlGeneratorModule::getInstance()->pagesArray;

        $response->format = Response::FORMAT_RAW;
        $response->headers->add('Content-Type', 'text/xml');
        $response->data = $this->renderPartial('sitemapXml', [
            'items' => $pages
        ]);
    }

    /**
     * Method to get the atom.xml file
     * return xml response
     */
    public function actionAtom()
    {
        $response = Yii::$app->response;

        $atomItems = XmlGeneratorModule::getInstance()->atomArray;

        $response->format = Response::FORMAT_RAW;
        $response->headers->add('Content-Type', 'text/xml');
        $response->data = $this->renderPartial('atomXml', [
            'items' => $atomItems
        ]);
    }

    /**
     * Method to get the rss.xml file
     * return xml response
     */
    public function actionRss()
    {
        $response = Yii::$app->response;

        $rssItems = XmlGeneratorModule::getInstance()->rssArray;

        $response->format = Response::FORMAT_RAW;
        $response->headers->add('Content-Type', 'text/xml');
        $response->data = $this->renderPartial('rssXml', [
            'items' => $rssItems
        ]);
    }
}
