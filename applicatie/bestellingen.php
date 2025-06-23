<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
        initial-scale=1.0">

    <title>Winkelmandje</title>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="styles.css">

</head>

<body>
    <?php include 'header.php'; ?>


    <main>
        <h2>In mijn winkelwagen:</h2>

        <div class="box-container">
            <div class="box">
                <img src="images/salami.png" alt="Pizza Salami" class="box-image">
                <p>Pizza Salami</p>
                <p>€8.99</p>
                <div class="hoeveelheid">
                    <button class="min">-</button>
                    <span class="aantal">2</span>
                    <button class="plus">+</button>
                </div>
            </div>
            <div class="box">
                <img src="images/cola.png" alt="Coca-Cola" class="box-image">
                <p>Coca-Cola</p>
                <p>€2.99</p>
                <div class="hoeveelheid">
                    <button class="min">-</button>
                    <span class="aantal">1</span>
                    <button class="plus">+</button>
                </div>
            </div>
        </div><br>
        <div class="totaalmenu">
            <div class="totaal">
                <p>Totaal: 3 Items | €20.97</p>
            </div>
            <div class="button-link">
                <a href="index.php">Verder winkelen</a>
            </div>
            <div class="button-link">
                <a href="betaling.php">Afrekenen</a>
            </div>
        </div>
    </main>

    <footer>
        <p>© 2024 Pizzeria Sole Machina. Alle rechten voorbehouden.</p>
    </footer>
</body>

</html>