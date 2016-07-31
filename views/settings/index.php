<h1>Asetukset</h1>

<h2>Vaihda salasana</h2>
<form action="index.php?p=settings&action=changePassword" method="post">
	<table>
		<tr><td>Vanha salasana: </td><td><input type="password" name="old_password"/></td></tr>
		<tr><td>Uusi salasana: </td><td><input type="password" name="new_password"/></td></tr>
		<tr><td>Toista uusi salasana: </td><td><input type="password" name="repeat_new_password"/></td></tr>
		<tr><td></td><td><input type="submit" value="Valmis"/></td></tr>
	</table>
</form>