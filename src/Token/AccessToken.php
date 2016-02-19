<?php

namespace Stevenmaguire\OAuth2\Client\Token;

class AccessToken extends \League\OAuth2\Client\Token\AccessToken
{
    /**
     * Instance URL
     *
     * @var string
     */
    private $instanceUrl;

    public function __construct(array $options)
    {
        parent::__construct($options);

        $this->instanceUrl = $options['instance_url'];
    }

    /**
     * @return string
     */
    public function getInstanceUrl()
    {
        return $this->instanceUrl;
    }
}