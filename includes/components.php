<?php

class Components{
	public $root;

	function __construct($root){
		$this->root = $root;
	}

	function navbar(){
		$html = '
			<div class="navbar">
				<a href="'.$this->root.'" class="navbar-brand">MateScholar</a>
				<ul class="nav">
					<li><a href="'.$this->root.'" class="nav-link">Home</a></li>
				</ul>
			</div>
		';
		return $html;
	}

	function admin_navbar(){
		$html = '
			<div class="navbar">
				<a href="'.$this->root.'" class="navbar-brand">MateScholar</a>
				<ul class="nav">
					<li><a href="'.$this->root.'admin/subjects.php" class="nav-link">Subjects</a></li>
					<li><a href="'.$this->root.'admin/users.php" class="nav-link">Users</a></li>
					<li><a href="'.$this->root.'" class="nav-link">Site</a></li>
				</ul>
			</div>
		';
		return $html;
	}

	function table($ths = [], $tds = [[]]){
		$html = '<table class="table">';

		$html .= '<tr>';
		for ($i=0; $i < count($ths); $i++) {
			$html .= '<th>'.$ths[$i].'</th>';
		}
		$html .= '</tr>';

		for ($i=0; $i < count($tds); $i++){
			$html .= '<tr>';
			for ($j=0; $j < count($tds[$i]); $j++) {
				$html .= '<td>'.$tds[$i][$j].'</td>';
			}
			$html .= '</tr>';	
		}

		$html .= '</table>';
		return $html;
	}
}

class Component {
	public $html;
	public $classes = [];
	public $id = "";
	public $attributes = [];

	function set_classes($classes = array()){
		$this->classes = $classes;
	}

	function classes_string($echo=false){
		$str = '';
		foreach ($this->classes as $class){
			$str .= " ".$class;
		}
		if ($echo) {
			echo $str;
		} else {
			return $str;
		}
	}

	function set_attributes($attrs = array()){
		$this->attributes = $attrs;
	}

	function attributes_string($echo=false){
		$str = '';
		foreach ($attributes as $key => $value) {
			$str .= " ".$key."='".$value."'";
		}
		if ($echo) {
			echo $str;
		} else {
			return $str;
		}
	}

	function render_html(){
		echo $this->html;
	}

}

class Table extends Component {
	public $ths;
	public $tds;

	function set_headings($ths = []){
		$this->ths = $ths;
	}

	function set_data($tds = [[]]){
		$this->tds = $tds;
	}

	function generate(){
		$html = '<table id="'.$this->id.'" class="table'.$this->classes_string().'">';

		$html .= '<tr>';
		for ($i=0; $i < count($this->ths); $i++) {
			$html .= '<th>'.$this->ths[$i].'</th>';
		}
		$html .= '</tr>';

		for ($i=0; $i < count($this->tds); $i++){
			$html .= '<tr>';
			for ($j=0; $j < count($this->tds[$i]); $j++) {
				$html .= '<td>'.$this->tds[$i][$j].'</td>';
			}
			$html .= '</tr>';	
		}

		$html .= '</table>';

		$this->html = $html;
	}
}

class InputGroup extends Component {
	public $element;
	public $type;
	public $name;
	public $value;
	public $placeholder;

	function set($element="input", $type="", $name="", $value="", $placeholder=""){
		$this->element = $element;
		$this->type = $type;
		$this->name = $name;
		$this->value = $value;
		$this->placeholder = $placeholder;
	}

	function generate() {
		$html = '<div class="input-group">';
		if ($this->element == "input") {
			$html .= $this->inputElement();
		}
		$html .= '</div>';
		$this->html = $html;
	}

	function inputElement(){
		$html = '<input class="form-control" type="'.$this->type.'" name="'.$this->name.'" value="'.$this->value
		.'" placeholder="'.$this->placeholder.'">';
		return $html;
	}
}

class Form extends Component {
	public $action = "";
	public $method = "post";
	public $input_groups = [];

	function set_inputGroups($input_groups){
		$this->input_groups = $input_groups;
	}

	function generate(){
		$html = '<form method="'.$this->method.'">';
		for($i=0; $i < count($this->input_groups); $i++){
			$inputGroup = new InputGroup();
			$inputGroup->set($this->input_groups[$i]["element"], $this->input_groups[$i]["type"], $this->input_groups[$i]["name"]);
			$inputGroup->generate();
			$html .= $inputGroup->html;
		}
		$html .= '</form>';
		$this->html = $html;
	}

}

?>