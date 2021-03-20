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

?>