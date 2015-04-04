<?php

namespace T4webPermissions\Identity;

use Zend\Authentication\AuthenticationServiceInterface;
use ZfcRbac\Identity\IdentityInterface;
use T4webAuthentication\Service as  AuthenticationService;

class Identity implements IdentityInterface, AuthenticationServiceInterface {

    /**
     * @var AuthenticationService
     */
    protected $authService;

    public function __construct(AuthenticationService $authService) {
        $this->authService = $authService;
    }

    public function getRoles() {
        return 'member';
    }

    public function authenticate() {
        return;
    }

    public function hasIdentity() {
        return $this->authService->hasIdentity();
    }

    public function getIdentity() {
        return $this;
    }

    public function clearIdentity() {
        return $this->authService->clearIdentity();
    }

}