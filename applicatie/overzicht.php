<?php require_once 'functies/data_functies.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,
        initial-scale=1.0">

    <title>Pizzeria Sole Machina</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <?php include 'header.php'; ?>
    <main>
        <h1>
            Overzicht bestellingen
        </h1>

        <div class="overzicht">
            <div class="overzichtboxje">
                <p>#10</p>
                <p>1x Pizza Margherita</p>
                <p>2x Pizza Salami</p>
                <p>Adres: Zevenaarweg 05, Arnhem</p>
                <select id="status1" name="status">
                    <option value="ontvangen">Bestelling ontvangen</option>
                    <option value="voorbereiden">Wordt gemaakt</option>
                    <option value="oven">In de oven</option>
                    <option value="wachten">Klaar voor vertrek</option>
                    <option value="Vertrokken">Onderweg</option>
                    <option value="Bezorgd">Bezorgd</option>
                </select>
            </div>
            <div class="overzichtboxje">
                <p>#11</p>
                <p>1x Pizza Hawaii</p>
                <p>1x Coca Cola</p>
                <p>Adres: Slotlaan 22, Arnhem</p>
                <select id="status2" name="status">
                    <option value="ontvangen">Bestelling ontvangen</option>
                    <option value="voorbereiden">Wordt gemaakt</option>
                    <option value="oven">In de oven</option>
                    <option value="wachten">Klaar voor vertrek</option>
                    <option value="Vertrokken">Onderweg</option>
                    <option value="Bezorgd">Bezorgd</option>
                </select>
            </div>
            <div class="overzichtboxje">
                <p>#12</p>
                <p>2x Pepperoni Pizza</p>
                <p>1x Coca Cola</p>
                <p>Adres: Kaasweg 65, Arnhem</p>
                <form>
                    <select id="status3" name="status">
                        <option value="ontvangen">Bestelling ontvangen</option>
                        <option value="voorbereiden">Wordt gemaakt</option>
                        <option value="oven">In de oven</option>
                        <option value="wachten">Klaar voor vertrek</option>
                        <option value="Vertrokken">Onderweg</option>
                        <option value="Bezorgd">Bezorgd</option>
                    </select>

                </form>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>

</body>

</html>