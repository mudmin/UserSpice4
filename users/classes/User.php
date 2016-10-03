<?php
/*
UserSpice 4
An Open Source PHP User Management System
by the UserSpice Team at http://UserSpice.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
class User {
	private $_db, $_data, $_sessionName, $_isLoggedIn, $_cookieName;

	public function __construct($user = null){
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		if (!$user) {
			if (Session::exists($this->_sessionName)) {
				$user = Session::get($this->_sessionName);

				if ($this->find($user)) {
					$this->_isLoggedIn = true;
				} else {
					//process Logout
				}
			}
		} else {
			$this->find($user);
		}
	}

	public function create($fields = array()){
		if (!$this->_db->insert('users', $fields)) {
			throw new Exception('There was a problem creating an account.');
		}else
		$user_id = $this->_db->lastId();
		$query = $this->_db->insert("groups_users",['user_id'=>$user_id,'group_id'=>1]);
		// return $user_id;
		$query2 = $this->_db->insert("profiles",['user_id'=>$user_id, 'bio'=>'This is your bio']);
		return $user_id;
	}

	public function find($user = null){
		if ($user) {
			if(is_numeric($user)){
				$field = 'id';
			}elseif(!filter_var($user, FILTER_VALIDATE_EMAIL) === false){
				$field = 'email';
			}else{
				$field = 'username';
			}

			$data = $this->_db->get('users', array($field, '=', $user));

			if ($data->count()) {
				$this->_data = $data->first();
				if($this->data()->account_id == 0 && $this->data()->account_owner == 1){
					$this->_data->account_id = $this->_data->id;
				}
				return true;
			}
		}
		return false;
	}

	public function login($username = null, $password = null, $remember = false){

		if (!$username && !$password && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->id);
		} else {
			$user = $this->find($username);
			if ($user) {
				if (password_verify($password,$this->data()->password)) {
					Session::put($this->_sessionName, $this->data()->id);
					if ($remember) {
						$hash = Hash::unique();
						$hashCheck = $this->_db->get('users_session' , array('user_id', '=', $this->data()->id));

							$this->_db->insert('users_session', array(
								'user_id' => $this->data()->id,
								'hash' => $hash,
								'uagent' => Session::uagent_no_version()
							));

						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}
					$this->_db->query("UPDATE users SET last_login = ?, logins = logins + 1 WHERE id = ?",[date("Y-m-d H:i:s"),$this->data()->id]);
					return true;
				}
			}
		}
		return false;
	}

	public function loginEmail($email = null, $password = null, $remember = false){

		if (!$email && !$password && $this->exists()) {
			Session::put($this->_sessionName, $this->data()->id);
		} else {
			$user = $this->find($email);

			if ($user) {
				if (password_verify($password,$this->data()->password)) {
					Session::put($this->_sessionName, $this->data()->id);

					if ($remember) {
						$hash = Hash::unique();
						$hashCheck = $this->_db->get('users_session' , array('user_id', '=', $this->data()->id));

							$this->_db->insert('users_session', array(
								'user_id' => $this->data()->id,
								'hash' => $hash,
								'uagent' => Session::uagent_no_version()
							));

						Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
					}
					$this->_db->query("UPDATE users SET last_login = ?, logins = logins + 1 WHERE id = ?",[date("Y-m-d H:i:s"),$this->data()->id]);
					return true;
				}
			}
		}
		return false;
	}

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}

	public function data(){
		return $this->_data;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}

	public function isAdmin(){
		if (!$this->_isLoggedIn)
			return false;
		if ($this->_data->id === 0)
			return true;
		if (!$adminGroups = Config::get('userspice/admin_groups'))
			$adminGroups = array(2); // default in UserSpice
		foreach ((array)$adminGroups as $group) {
			if ( $this->_db->query('SELECT * FROM groups_users WHERE user_id = ? AND group_id = ?', array($this->_data->id, $group))->count() > 0)
				return true;
		}
		return false;
	}

	public function notLoggedInRedirect($location){
		if($this->_isLoggedIn){
			return true;
		}else{
			Redirect::to($location);
		}
	}

	public function logout(){
		$this->_db->query("DELETE FROM users_session WHERE user_id = ? AND uagent = ?",array($this->data()->id,Session::uagent_no_version()));

		Session::delete($this->_sessionName);
		Cookie::delete($this->_cookieName);
	}

	public function update($fields = array(), $id=null){

		if (!$id && $this->isLoggedIn()) {
			$id = $this->data()->id;
		}

		if (!$this->_db->update('users', $id, $fields)) {
			throw new Exception('There was a problem updating.');
		}
	}

	# PLB CODE-REVIEW ASDF - I don't understand what this is looking for?
	# I have deleted hasPermission() and noPermissionRedirect()
}
