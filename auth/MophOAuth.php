<?php

namespace app\auth;

#namespace app\authclient\clients;

use yii\authclient\OAuth2;

/**
 * Moph allows authentication via Moph OAuth.
 *
 *
 * Example application configuration:
 *
 * ```php
 * 'components' => [
 *     'authClientCollection' => [
 *         'class' => 'app\auth\Moph',
 *         'clients' => [
 *             'moph' => [
 *                 'class' => 'yii\app\clients\MophOAuth',
 *                 'clientId' => 'google_client_id',
 *                 'clientSecret' => 'google_client_secret',
 *             ],
 *         ],
 *     ]
 *     ...
 * ]
 * ```
 *
 *
 * @author Sila Klnaklaeo <p_taung@hotmail.com>
 * @since 2.0
 */
class MophOAuth extends OAuth2 {

    /**
     * @inheritdoc
     */
    public $authUrl = 'http://203.157.119.3/clientservice/web/index.php/auth';

    /**
     * @inheritdoc
     */
    public $tokenUrl = 'http://203.157.119.3/clientservice/web/index.php/oauth2/token';

    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'http://203.157.119.3/clientservice/web/index.php/api';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        /*
          if ($this->scope === null) {
          $this->scope = implode(' ', [
          'profile',
          'user',
          ]);
          }
         *
         */
    }

    /**
     * @inheritdoc
     */
    protected function initUserAttributes() {
        return $this->api('index', 'get');
    }

    /**
     * @inheritdoc
     */
    public function applyAccessTokenToRequest($request, $accessToken) {
        $data = $request->getData();
        $data['accessToken'] = $accessToken->getToken();
        $request->setData($data);
    }

    /**
     * @inheritdoc
     */
    protected function defaultName() {
        return 'moph';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle() {
        return 'Moph';
    }

}
