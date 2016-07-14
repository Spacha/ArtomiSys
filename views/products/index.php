<?php

$count = count($this->data);

?>
<h1>Tuotteet <span><?=$count;?></span></h1>

<a href="?p=products&action=edit" class="tool">+ Lisää uusi tuote</a>
<br />
<br />

<table class="list">
	<tr><th>#</th><th>Tuotteen nimi</th><th>Luotu</th><th>Työkalut</th></tr>

<?php

if (count($this->data) >= 1 && is_array($this->data)) {
	foreach($this->data as $i) {	
		$date = date("d.m.Y - h.i", $i['date']);
		echo "<tr><td>{$i['id']}</td><td><a href=\"index.php?p=products&action=view&id={$i['id']}\">{$i['header']}</a></td><td>{$date}</td><td><a href=\"index.php?p=products&action=edit&id={$i['id']}\">Muokkaa</a> /
		<a href=\"index.php?p=products&action=confirmDelete&id={$i['id']}\">Poista</a></td></tr>";
	}
} else {
	echo "<b>Ei tuotteita.</b>";
}
?>
</table>