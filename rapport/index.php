<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend Rapport - Projekt 2</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div id="container">
        <!-- Logo och huvudmeny-->
        <?php include "../elements/header.php" ?>

        <!-- Sektionen omringar artiklar (eg. blogposts)-->
        <section>
            <article>
                <h2>Projekt 2 - Dejtapp</h2>
                <h3>Om databasen</h3>
                <p>Projektet är en flersidig webbsida som är baserad på PHP och en PDO (PHP Data Object) uppkopplingen till en databas. Webbsidan tar emot från användaren, sparar och sedan visar data som befinner sig i flera tabeller inom databasen. Webbsidan kommunicerar med databasmotorn via SQL språket och sådana kommandon som SELECT, INSERT INTO, UPDATE och DELETE</p>
                <p>Datan lagras i databaser som uppsättning kolumner och rader. Varje element i en databas (en rad) har sina värden som motsvarar tabells kolumner. En av värden är en ID som är ett unikt värde för varje rad. Värden kan lagras i olika format (integer, string, varchar, timestamp, etc.).</p>
                <p><img src="../media/example_1.png"><br>Exempel på en tabell i databasen.</p>
                <p>Om man har olika tabeller i en databas är det möjligt att kombinera datan från de här tabellerna med JOIN … ON … kommandon som matchar tabeller enligt värden i en kolumn från varje tabell. Till exempel, om man kör <i>“SELECT users.id, users.username, comments.comment FROM users JOIN comments ON users.id = comments.sender_id”</i> kommandot som slår ihop users och comments tabeller får man resultat som visar dem användarna som har skickat kommentarer och vilka kommentarer de har skickat. Det finns även kommandon som LIKE, WHERE för att söka specifika rader/element, SORT BY för att arrangera resultat på olika sätt och LIMIT för att begränsa antal rader i resultaten. </p>
                <p><img src="../media/example_2.png"><br>Exempel på JOIN kommandot</p>
                <h3>Självreflektion</h3>
                <p>Det här projektet gjorde mig behärska metoder för hur webbsidor lagrar och behandlar data i databaser. Jag lärde mig hur lösenorden skickas till server och behandlas säkert på serversidan, hur webbplatser använder SQL och hur man når och kombinerar data från flera tabeller för att visa innehåll som precis behövs. Det här projektet gick ganska roligt och nu känner jag mig mera självsäker och kunnig för att skapa dynamiska, mera engagerade webbsidor. </p>
                <p>Det första uppmaningen som jag stod inför var att skapa ett registreringsformulär som skickar användarens profiluppgifter till databasen. Jag spenderade ganska mycket tid på att få SQL query funka särskilt med NULL-värden (för att inte alla fällt är obligatoriska att fyllas in). Jag blev förvirrad när på gästföreläsningen introducerades PDO och klasser och det var inte lätt att bestämma mig vilken väg att välja för mitt projekt efteråt – PDO eller MySQLi. </p>
                <p>Sedan kom uppmaningen att göra annonssidor att se snyggt ut. Jag lade till några if-satser på profilsidan för att göra den mera intelligent om vem är den som tittar på sidan – profilsägare, annan användare eller oregistrerade besökare. Det tog en stund att skapa filtret, få värden och klistra variabler in i SQL query för att införa sortering och filtrering på annonssidan. </p>
                <p>Till slut fick jag alla delar av uppgiften att fungera. Jag lade till även extra funktionalitet så som lösenordverifiering, extra sorteringsalternativ och begränsning att lämna kommentarer på sin egen profilsida. Jag trivdes med att jobba på detta projekt och ser fram emot att lära mig mera om Content Management Systems (CMS).</p>
            </article>

        </section>

        <!-- Footern innehåller t.ex. somelänkar och kontaktuppg -->
        <?php include "../elements/footer.php" ?>

    </div>
</body>

</html>