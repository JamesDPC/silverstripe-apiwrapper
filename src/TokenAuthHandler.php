<?php

namespace Symbiote\ApiWrapper;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Security\AuthenticationHandler;
use SilverStripe\Security\Member;
use SilverStripe\Security\Security;

class TokenAuthHandler implements AuthenticationHandler
{
    public $tokenHeader = 'X-Auth-Token';

    public function authenticateRequest(HTTPRequest $request)
    {
        if ($token = $request->getHeader($this->tokenHeader)) {
            if (str_contains((string) $token, ':') === 0 || str_contains((string) $token, ':') === false) {
                return null;
            }

            [$uid, $token] = explode(':', (string) $token, 2);
            // done directly against the DB because we don't have a user context yet
            /**
             * @var Member
             */
            $user = Member::get()->byID($uid);
            if ($user && $user->exists()) {
                $hash = $user->encryptWithUserSettings($token);
                // we're not comparing against the RawToken because we want the 'slow' process above to execute
                if ($hash == $user->Token) {
                    return $user;
                }
            }
        }
        return null;
    }

    public function logIn(Member $member, $persistent = false, ?HTTPRequest $request = null)
    {
        Security::setCurrentUser($member);
    }

    public function logOut(?HTTPRequest $request = null)
    {
        Security::setCurrentUser(null);
    }
}
