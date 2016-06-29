<?php

namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController
{
    public function loginAction(Request $request)
    {

        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        } else {
            $request->getSession()->getFlashBag()->add('error', $error->getMessage());
        }

        if (is_null($error)) {
            // TODO: redirect to profile page, otherwise to homepage with error
            return new RedirectResponse($this->generateUrl('wege_coupon_homepage'));
        } else {
            return new RedirectResponse($this->generateUrl('wege_coupon_homepage'));
        }
    }

    public function ajaxLoginAction(Request $request)
    {
        $

        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        } else {
            $request->getSession()->getFlashBag()->add('error', $error->getMessage());
        }

        if (is_null($error)) {
            // TODO: redirect to profile page, otherwise to homepage with error
            return new RedirectResponse($this->generateUrl('wege_coupon_homepage'));
        } else {
            return new RedirectResponse($this->generateUrl('wege_coupon_homepage'));
        }
    }
}