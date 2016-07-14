<?php

$date = date("d.m.Y - H.i", $this->data['date']);

echo "<center>";

foreach($this->data['img'] as $img) {
	if(isset($img) && $img !== false) {
		echo "<img src=\"uploads/products/". $img ."\" style=\"height:250; margin: 4px;\">";
	}
}

echo "</center>";
echo "<h1>". $this->data['header'] ."</h1>";
echo "<table>";
echo "<tr><td><b>Luotu: </b></td><td><i>" .$date. "</i></td></tr>";
echo "<tr style='vertical-align: top;'><td><b>Kuvaus: </b></td><td>". $this->data['content'] ."</td></tr>";

?>

</table>

<br /><br />

<a href="index.php?p=products" class="cancel">Takaisin</a> <a href="index.php?p=products&action=edit&id=<?=$this->data['id'];?>" class="ok">Muokkaa</a>