<?php
/**
 * Created by PhpStorm.
 * User: v_wenlqiu
 * Date: 2017/12/29
 * Time: 17:54
 */

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;

class MyEloquentUserProvider extends EloquentUserProvider
{
    public function validateCredentials( UserContract $user, array $credentials )
    {

        $plain        = $credentials[ 'loginPwd' ];

        $authPassword = $user->getAuthPassword();
        
        return $this->hasher->check($plain, $authPassword);
    }

    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials)) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {
            if (! Str::contains($key, 'loginPwd')) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

}