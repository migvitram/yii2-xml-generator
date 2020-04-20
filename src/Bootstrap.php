<?php

namespace migvitram\xmlgenerator;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Module;

class Bootstrap implements BootstrapInterface
{
    /**
     * To bootstrap out module
     *
     * @param Application $app
     */
    public function bootstrap($app)
    {
        if ( $app->hasModule('xmlGenerator') && ($module = $app->getModule('xmlGenerator')) instanceof Module ) {

            $configUrlRule = [
                'rules'  => $module->urlRules,
            ];

            $configUrlRule['routePrefix'] = 'xmlGenerator';
            $configUrlRule['class'] = 'yii\web\GroupUrlRule';
            $rule = Yii::createObject($configUrlRule);

            $app->urlManager->addRules([$rule], false);
        }
    }
}