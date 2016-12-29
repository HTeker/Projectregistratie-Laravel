<?php

use Illuminate\Auth\UserInterface;

class Account extends \Eloquent implements UserInterface {
	protected $fillable = ['voornaam','tussenvoegsel','achternaam','email','wachtwoord','wachtwoord_herhalen'];

	public function setWachtwoordAttribute($pass){
		$this->attributes['wachtwoord'] = Hash::make($pass);
	}

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('wachtwoord');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier(){
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword(){
        return $this->wachtwoord;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken(){
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value){
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName(){
        return 'remember_token';
    }
}