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
				
				$i = 1;
				
				foreach($this->data['img'] as $img) {
					if(isset($img) && $img !== false) {
						echo "<div id=\"img_{$i}\" style=\"text-align: center; float: left; background: #CCC; margin: 4px; padding: 4px;\"><img src=\"uploads/products/". $img ."\" style=\"height: 100px; margin: 4px;\"><br />";
						echo "<label for=\"remove_$i\">Poista</label> <input type=\"checkbox\" id=\"remove_$i\"/ name=\"remove_$i\"/></div>";
						$i++;
					}
				}
				
				echo "<p class='clear'></p>";
				
				// TODO: Don't hardcode!
				$maxImgSlots = 3;
				$imgSlots = $maxImgSlots - count($this->data['img']);
				
				for($i = 0; $i < $imgSlots; $i++)
				{
					$n = $i+1;
					
					echo "<div style=\"background: #CCC; margin: 4px; padding: 4px;\">Lisää kuva: <input type=\"file\" name=\"img_file$n\" id=\"img_file$n\" class=\"img_file\"/></div>";
				}
				
				?>
				</td>
			</tr>
			<tr><td></td><td><a href="index.php?p=products" class="cancel">Peruuta</a> <input type="submit" value="Valmis"/></td></tr>
	</form>
</table>