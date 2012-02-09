<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    private $_id;

	public function authenticate()
	{
        $get =  User::model()->find('username = :username', array(':username'=>$this->username));
		if($get === NULL)
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($get->password!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->errorCode=self::ERROR_NONE;
            $this->_id = $get->iduser;

        }
		return !$this->errorCode;
	}
    public function getId(){
   		return $this->_id;
   	}
}