<?php

namespace console\controllers;

use common\models\User;
use DomainException;
use yii\console\Controller;

/**
 * Interactive console users manager
 */
class AdminController extends Controller
{

    /**
     * Create user and add role to him
     */
    public function actionCreate(): void {
        $this->stdout('Create new admin:' . PHP_EOL);
        $user = new User();
        $user->username = $this->prompt('Login:', ['required' => true]);
        $user->setPassword($this->prompt('Password:', ['required' => true]));
        $user->status   = 10;

        try {
            if (!$user->save()) {
                print_r(['Errors:', implode(',', $user->getFirstErrors())]);
                exit;
            }

            $this->stdout('Successfully saved!' . PHP_EOL);
        } catch (DomainException $e) {
            $this->stdout('Errors: ' . $e->getMessage() . PHP_EOL);
        }
    }
}
