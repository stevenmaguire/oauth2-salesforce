# Salesforce Provider for OAuth 2.0 Client

[![Latest Version](https://img.shields.io/github/release/stevenmaguire/oauth2-salesforce.svg?style=flat-square)](https://github.com/stevenmaguire/oauth2-salesforce/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/stevenmaguire/oauth2-salesforce/master.svg?style=flat-square)](https://travis-ci.org/stevenmaguire/oauth2-salesforce)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/stevenmaguire/oauth2-salesforce.svg?style=flat-square)](https://scrutinizer-ci.com/g/stevenmaguire/oauth2-salesforce/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/stevenmaguire/oauth2-salesforce.svg?style=flat-square)](https://scrutinizer-ci.com/g/stevenmaguire/oauth2-salesforce)
[![Total Downloads](https://img.shields.io/packagist/dt/stevenmaguire/oauth2-salesforce.svg?style=flat-square)](https://packagist.org/packages/stevenmaguire/oauth2-salesforce)

This package provides Salesforce OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Installation

To install, use composer:

```
composer require stevenmaguire/oauth2-salesforce
```

## Usage

Usage is the same as The League's OAuth client, using `\Stevenmaguire\OAuth2\Client\Provider\Salesforce` as the provider.

### Authorization Code Flow

```php
$provider = new Stevenmaguire\OAuth2\Client\Provider\Salesforce([
    'clientId'          => '{salesforce-client-id}',
    'clientSecret'      => '{salesforce-client-secret}',
    'redirectUri'       => 'https://example.com/callback-url',
    'domain'            => '{custom-salesforce-domain}' // optional, defaults to https://login.salesforce.com
]);
```
For further usage of this package please refer to the [core package documentation on "Authorization Code Grant"](https://github.com/thephpleague/oauth2-client#usage).

### Getting and/or Refreshing a Token

```php
$provider = new Stevenmaguire\OAuth2\Client\Provider\Salesforce([
    'clientId'          => '{salesforce-client-id}',
    'clientSecret'      => '{salesforce-client-secret}',
    'redirectUri'       => 'https://example.com/callback-url',
]);

//Here are two options for getting the required token.

// Option 1: You have a token already saved in your local data store.
// Create a routine to pull that token from your local data storage.
$thisAccessToken = getAccessTokenFromYourDataStore();

// Option 2: You don't have a pre-saved token or that local storage call failed (e.g. empty($thisAccessToken) ). 
// Use the Salesforce OAuth API to provide a token good for only this session.
if empty($thisAccessToken) {
    $thisAccessToken = $provider->getAccessToken('password', ['username'=>'USERNAME', 'password' => 'PASSWORD']);
}

// Once you have a token you can check if it's expired and refresh
if ($thisAccessToken->hasExpired()) {
    $newAccessToken = $provider->getAccessToken('refresh_token', [
        'refresh_token' => $thisAccessToken->getRefreshToken()
    ]);

    // If using Option 1: Purge old access token and store new access token to your data store.
    // If using Option 2: $thisAccessToken = $newAccessToken;

}
```

### Using a custom Salesforce domain

```php
$provider->setDomain('https://foo-bar.salesforce.com');
```

For further usage of this package please refer to the [core package documentation on "Refreshing a Token"](https://github.com/thephpleague/oauth2-client#refreshing-a-token).

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](https://github.com/stevenmaguire/oauth2-salesforce/blob/master/CONTRIBUTING.md) for details.


## Credits

- [Steven Maguire](https://github.com/stevenmaguire)
- [All Contributors](https://github.com/stevenmaguire/oauth2-salesforce/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/stevenmaguire/oauth2-salesforce/blob/master/LICENSE) for more information.
