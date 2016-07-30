<script>
	/*
	function removeImg(img)
	{
        document.getElementById(img).innerHTML='Kuva poistettu.<br/><a style="cursor: pointer;" onclick="undoImgRemoval(\''+img+'\')">Kumoa</a>';
		// document.getElementById(img).style.display='none';
    }
	function undoImgRemoval(img)
	{
        document.getElementById(img).innerHTML='Poisto kumottu.';
		
    }
    
    echo "<div id=\"img_{$i}\" style=\"text-align: center; float: left; background: #CCC; margin: 4px; padding: 4px;\"><img src=\"uploads/products/". $img ."\" style=\"height: 100px; margin: 4px;\"><br />";
	echo "<a style=\"cursor: pointer;\" onclick=\"removeImg('img_$i')\">Poista</a></div>";
	/*
</script>

<h1>Muokkaa tuotetta <span>ID: <?=$this->data['id'];?></span></h1>

<table class="form">
	<form action="index.php?p=products&action=saveProduct&id=<?php echo $this->data['id']?>" method="post" enctype="multipart/form-data">
		<tr><td><b>Nimi: </b></td><td><input type="text" name="header" value="<?php echo $this->data['header']?>"/></td></tr>
		<tr><td><b>Kuvaus: </b></td>
			<td><textarea name="content" style="width: 400px; height: 400px;"><?php echo $this->data['content']?></textarea></td></tr>
			<input type="hidden" name="date" value="<?php echo $this->data['date']?>"/>
			<tr>
				<td></td>
				<td>
				<?php
				
				/*
				This shit is really fucked up. Fix it
				*/
				
				$i = 1;
				$reserved_nums = array();
				
				foreach($this->data['img'] as $img) {
					if(isset($img) && $img !== false) {
						
						$img_num = $img['num'];
						$remove_num = "remove_".$img_num;
						echo "<div id=\"img_{$i}\" style=\"text-align: center; float: left; background: #CCC; margin: 4px; padding: 4px;\"><img src=\"uploads/products/". $img['img'] ."\" style=\"height: 100px; margin: 4px;\"><br />";
						echo "<label for=\"$remove_num\">Poista</label> <input type=\"checkbox\" id=\"$remove_num\"/ name=\"$remove_num\"/></div>";
						array_push($reserved_nums, $img_num);
						$i++;
					}
				}
				
				echo "<p class='clear'></p>";
				//print_r($reserved_nums);
				$imgSlots = 3;
				
				for($i = 0; $i < $imgSlots; $i++)
				{
					$n = $i+1;
					
					if (in_array($n, $reserved_nums)) {
						continue;
					}
					
					echo "<div style=\"background: #CCC; margin: 4px; padding: 4px;\">Lisää kuva: <input type=\"file\" name=\"img_file_$n\" id=\"img_file_$n\" class=\"img_file\"/></div>";
				}
				
				?>
				</td>
			</tr>
			<tr><td></td><td><a href="index.php?p=products" class="cancel">Peruuta</a> <input type="submit" value="Valmis"/></td></tr>
	</form>
</table>