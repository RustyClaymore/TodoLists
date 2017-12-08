<?php

class UserRegistrationController
{
    public function registerUser(User $model): bool
    {
        return $model->registerUser();
    }

}
