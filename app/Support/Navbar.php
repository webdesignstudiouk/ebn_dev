<?php
namespace App\Support;

class Navbar {
	
	public static function create_navbar($navItems = array(), $type = "horizontal"){
		$navItems;
		
		if($type == "horizontal"){
			$navbar = self::create_horizontal_navbar($navItems);
		}else{
			$navbar = self::create_vertical_navbar($navItems);
		}
		
		echo $navbar;
	}
	
	public static function create_horizontal_navbar($navItems){
		$navbar = "<ul class='nav nav-4 box bg-white'>";
		foreach($navItems as $item){
			if($item == "divider"){
				$navbar .= "</ul><ul class='nav nav-4 box bg-white'>"; 
			}else{
				$link = url($item['link']);
				
				$navbar .= "<li class='nav-item'>";
				$navbar .= "<a class='nav-link ".active([$item['link']])."' href='".$link."'>";
				if(isset($item['icon'])){
					$navbar .= "<i class='".$item['icon']."'></i> ";
				}
				$navbar .= $item['name'];
				if(isset($item['count'])){
					if(isset($item['count-type'])){
						$count_type = $item['count-type'];
					}else{
						$count_type = "success";
					}
					$navbar .= "<div class='tag tag-".$count_type." float-xs-right'>".$item['count']."</div>";
				}	
				$navbar .= "</a>";
				$navbar .= "</li>";
			}
		}
		$navbar .= "</ul>";
		
		return $navbar;
	}
	
	public static function create_vertical_navbar($navItems){
		$this->navbar = $navbar;
	}
	
}

?>