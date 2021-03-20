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
					<li><a href="'.$this->root.'admin/users.php" class="nav-link">Users</a></li>
					<li><a href="'.$this->root.'" class="nav-link">Site</a></li>
				</ul>
			</div>
		';
		return $html;
	}
}

?>