<h1>Lisää uusi tuote</h1>

<table class="form">
	<form action="index.php?p=products&action=saveProduct" method="post" enctype="multipart/form-data">
		<tr><td><b>Nimi: </b></td><td><input type="text" name="header"/></td></tr>
		<tr><td><b>Kuvaus: </b></td>
		<td><textarea name="content" style="width: 400px; height: 400px;"></textarea></td></tr>
		
		<tr><td>Kuva 1: </td> <td><input type="file" name="img_file1" id="img_file1" class="img_file"/></td></tr>
		<tr><td>Kuva 2: </td> <td><input type="file" name="img_file2" id="img_file2" class="img_file"/></td></tr>
		<tr><td>Kuva 3: </td><td><input type="file" name="img_file3" id="img_file3" class="img_file"/></td></tr>
		
		<tr><td></td><td><a href="index.php?p=products" class="cancel">Peruuta</a> <input type="submit" value="Valmis"/></td></tr>
	</form>
</table>