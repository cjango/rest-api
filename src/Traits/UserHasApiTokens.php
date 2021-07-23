<?php

namespace Jason\Rest\Traits;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Passport\Passport;
use Laravel\Passport\PersonalAccessTokenFactory;
use Laravel\Passport\PersonalAccessTokenResult;
use Laravel\Passport\Token;

trait UserHasApiTokens
{

    /**
     * The current access token for the authentication user.
     * @var \Laravel\Passport\Token
     */
    protected Token $accessToken;

    /**
     * Get all of the user's registered OAuth clients.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Passport::clientModel(), 'user_id');
    }

    /**
     * Get all of the access tokens for the user.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tokens(): HasMany
    {
        return $this->hasMany(Passport::tokenModel(), 'user_id')->orderBy('created_at', 'desc');
    }

    /**
     * Get the current access token being used by the user.
     * @return \Laravel\Passport\Token|null
     */
    public function token(): ?Token
    {
        return $this->accessToken;
    }

    /**
     * Determine if the current API token has a given scope.
     * @param  string  $scope
     * @return bool
     */
    public function tokenCan(string $scope): bool
    {
        return $this->accessToken && $this->accessToken->can($scope);
    }

    /**
     * Notes   : 重写的 createToken 方法，创建新的token时，自动作废之前的token
     * @Date   : 2021/7/23 10:24 上午
     * @Author : < Jason.C >
     * @param  string  $name
     * @param  array  $scopes
     * @return \Laravel\Passport\PersonalAccessTokenResult
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function createToken(string $name, array $scopes = []): PersonalAccessTokenResult
    {
        if (config('rest.token_auto_revoke')) {
            Token::where('user_id', $this->getKey())->update(['revoked' => 1]);
        }

        return Container::getInstance()->make(PersonalAccessTokenFactory::class)->make(
            $this->getKey(), $name, $scopes
        );
    }

    /**
     * Set the current access token for the user.
     * @param  \Laravel\Passport\Token  $accessToken
     * @return $this
     */
    public function withAccessToken(Token $accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

}