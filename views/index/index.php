<h1>Yleisnäkymä</h1>

<div style="border: 1px solid #CCC; padding: 8px; margin: 8px 0; color: #444; background: #FFC;">
    <h2>Tervetuloa <?=$_SESSION['username'];?>!</h2>
    <p>Tervetuloa ArtomiSysiin. Tätä kautta pystyt hallitsemaan tuotekatalogia helposti ja nopeasti. ArtomiSys on suunniteltu käytettäväksi pääosin tietokoneella, mutta päivitys onnistuu myös tabletti- ja mobiililaitteilla. <i>Muista kirjautua ulos päivityksen jälkeen turvallisuuden takaamiseksi.</i></p>
    <p>Lisää ohjeita voit lukea <a href="index.php?p=index&action=help">täältä</a>. Ongelmatapauksissa ota yhteyttä sähköpostilla osoitteeseen: <i>miikasikala96@gmail.com</i> tai puhelimitse numeroon: 045 624 0118.</p>
</div>

<table class="hor-list">
<?php

$lastChangedPassword = round(date("U", (date("U") - $this->data["lastChangedPassword"]))/86400);

echo "<tr><td><b>Sivuja: </b></td><td>" .$this->data["pagesCount"]. "</td></tr>";
echo "<tr><td><b>Tuotteita: </b></td><td>" .$this->data["productsCount"]. "</td></tr>";
echo "<tr><td><b>Salasana vaihdettu: </b></td><td>" .$lastChangedPassword. " päivää sitten.</td></tr>";
?>
</table>