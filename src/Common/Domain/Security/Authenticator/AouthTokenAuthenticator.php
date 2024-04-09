<?php

namespace App\Common\Domain\Security\Authenticator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;

class AouthTokenAuthenticator extends AbstractAuthenticator
{

    public function supports(Request $request): ?bool
    {
        return $request->headers->has('AUTHORIZATION');
    }

    public function authenticate(Request $request): Passport
    {
        $token = $request->headers->get('AUTHORIZATION');

        if (!$token) {
            // The token header was empty, authentication fails with HTTP Status
            // Code 401 "Unauthorized"
            throw new CustomUserMessageAuthenticationException('No API token provided');
        }

        return new SelfValidatingPassport(new UserBadge($apiToken));

        if (!$header) {
            return null;
        }


        if (!preg_match('/' . preg_quote(self::TOKEN_BEARER_HEADER_NAME, '/') . '\s(\S+)/', $header, $matches)) {
            return null;
        }

        $token = $matches[1];

        if ($removeFromRequest) {
            $request->headers->remove('AUTHORIZATION');
        }

        return $token;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        // TODO: Implement onAuthenticationFailure() method.
    }
}