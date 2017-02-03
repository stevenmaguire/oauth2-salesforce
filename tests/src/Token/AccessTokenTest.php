<?php
namespace Stevenmaguire\OAuth2\Client\Test\Token;

use Stevenmaguire\OAuth2\Client\Provider\Salesforce;
use Stevenmaguire\OAuth2\Client\Token\AccessToken;

class AccessTokenTest extends \PHPUnit_Framework_TestCase
{
    protected function getJson()
    {
        $json = file_get_contents(dirname(dirname(dirname(__FILE__))) . '/access_token_response.json');
        $data = json_decode($json, true);

        return $data;
    }

    /**
     * @dataProvider orgIdDataProvider
     *
     * @param string      $expectedOrgId
     * @param AccessToken $accessToken
     */
    public function testOrgIdMatchesExpectedOutput($expectedOrgId, AccessToken $accessToken)
    {
        $this->assertEquals($expectedOrgId, $accessToken->getOrgId());
    }

    public function orgIdDataProvider()
    {
        return [
            [ // 15 character ID
                '00Dx0000001T0zk',
                $this->getAccessToken('00Dx0000001T0zk')
            ],
            [ // 18 character ID
                '00Dx0000001T0zkEAY',
                $this->getAccessToken('00Dx0000001T0zkEAY')
            ]
        ];
    }

    public function getAccessToken($orgId = null)
    {
        $data = $this->getJson();

        if (!is_null($orgId)) {
            $data['resource_owner_id'] = sprintf('http://na1.salesforce.com/id/%s/005x0000001S2b9', $orgId);
        } else {
            $data['resource_owner_id'] = $data[Salesforce::ACCESS_TOKEN_RESOURCE_OWNER_ID];
        }

        return new AccessToken($data);
    }
}
