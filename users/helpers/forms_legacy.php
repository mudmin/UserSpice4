<?php //UserSpice Legacy Form Builder

if(!function_exists('generateForm')) {
	function generateForm($table,$id, $skip=[]){
		$db = DB::getInstance();
		$fields = [];
		$q=$db->query("SELECT * FROM {$table} WHERE id = ?",array($id));
		$r=$q->first();

		foreach($r as $field => $value) {
			if(!in_array($field, $skip)){
				echo '<div class="form-group">';
				echo '<label for="'.$field.'">'.ucfirst($field).'</label>';
				echo '<input type="text" class="form-control" name="'.$field.'" id="'.$field.'" value="'.$value.'">';
				echo '</div>';
			}
		}
		return true;
	}
}

if(!function_exists('generateAddForm')) {
	function generateAddForm($table, $skip=[]){
		$db = DB::getInstance();
		$fields = [];
		$q=$db->query("SELECT * FROM {$table}");
		$r=$q->first();

		foreach($r as $field => $value) {
			if(!in_array($field, $skip)){
				echo '<div class="form-group">';
				echo '<label for="'.$field.'">'.ucfirst($field).'</label>';
				echo '<input type="text" class="form-control" name="'.$field.'" id="'.$field.'" value="">';
				echo '</div>';
			}
		}
		return true;
	}
}

if(!function_exists('updateFields2')) {
	function updateFields2($post, $skip=[]){
		$fields = [];
		foreach($post as $field => $value) {
			if(!in_array($field, $skip)){
				$fields[$field] = sanitize($post[$field]);
			}
		}
		return $fields;
	}
} 
