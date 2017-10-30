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
class Validate{
	private $_passed = false,
			$_errors = array(),
			$_db = null;

	public function __construct(){
		$this->_db = DB::getInstance();
	}

	public function check($source, $items = array()){
		$this->_errors = [];
		foreach ($items as $item => $rules) {
			$item = sanitize($item);
			$display = $rules['display'];
			foreach ($rules as $rule => $rule_value) {
				$value = trim($source[$item]);
				$value = sanitize($value);

				if ($rule === 'required' && empty($value)) {
					$this->addError(["{$display} is required",$item]);
				} else if(!empty($value)){
					switch ($rule) {
						case 'min':
							if (strlen($value) < $rule_value) {
								$this->addError(["{$display} must be a minimum of {$rule_value} characters.",$item]);
							}
							break;

						case 'max':
							if (strlen($value) > $rule_value) {
								$this->addError(["{$display} must be a maximum of {$rule_value} characters.",$item]);
							}
							break;

						case 'matches':
							if ($value != $source[$rule_value]) {
								$match = $items[$rule_value]['display'];
								$this->addError(["{$match} and {$display} must match.",$item]);
							}
							break;

						case 'unique':
							$check = $this->_db->get($rule_value, array($item, '=', $value));
							if ($check->count()) {
								$this->addError(["{$display} already exists. Please choose another {$display}.",$item]);
							}
							break;

						case 'unique_update':
							$t = explode(',', $rule_value);
							$table = $t[0];
							$id = $t[1];
							$query = "SELECT * FROM {$table} WHERE id != {$id} AND {$item} = '{$value}'";
							$check = $this->_db->query($query);
							if ($check->count()) {
								$this->addError(["{$display} already exists. Please choose another {$display}.",$item]);
							}
							break;

						case 'is_numeric':
							if (!is_numeric($value)) {
								$this->addError(["{$display} has to be a number. Please use a numeric value.",$item]);
							}
							break;

						case 'valid_email':
							if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
								$this->addError(["{$display} must be a valid email address.",$item]);
							}
							break;
					}
				}
			}

		}

		if (empty($this->_errors)) {
			$this->_passed = true;
		}
		return $this;
	}

	public function addError($error){
		$this->_errors[] = $error;
		if(empty($this->_errors)){
			$this->_passed = true;
		}else{
			$this->_passed = false;
		}
	}

	public function display_errors(){
		$html = '<ul class="bg-danger">';
		foreach($this->_errors as $error){
			if(is_array($error)){
				$html .= '<li class="text-danger">'.$error[0].'</li>';
				$html .= '<script>jQuery("document").ready(function(){jQuery("#'.$error[1].'").parent().closest("div").addClass("has-error");});</script>';
			}else{
				$html .= '<li class="text-danger">'.$error.'</li>';
			}
		}
		$html .= '</ul>';
		return $html;
	}

	public function errors(){
		return $this->_errors;
	}

	public function passed(){
		return $this->_passed;
	}
}