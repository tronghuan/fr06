<div id="slider-main-container">	
	<div id="slider-sort" class="dd">
	<?php 
		$folder = "public/images/product/";
		if (empty($slider)){
			echo "<h4>Add product to add to the banner</h4>";
		}
		else {
			echo '<ul id="slider-sort-container">';
			foreach ($slider as $key=>$value){
				echo "<li pro='".$value['pro_id']."' img='".$value['img_link']."' id='".$value['img_order']."' class='slider-item'>";
				echo "<img src='".base_url($folder.$value['image_name'])."' height='40' width='40'>";
				echo "<p>".$value['product_name']."</p>";
				echo "<div class='slider-delete' pro='".$value['pro_id']."'>Delete</div>";
				echo "</li>";
			}
			echo '</ul>';
		}
	?>
	</div>
</div>