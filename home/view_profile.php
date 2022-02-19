<article>
    <h2>Din profil</h2>
    <p><a href="profile.php?page=edit">Ändra profil</a></p>
    <?php
        $username = $_SESSION["username"];

        $sql = "SELECT fullname, city, email, salary, text, preference FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);
    ?>
    <?php if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <p>
            Fullständiga namn: <?= $row["fullname"] ?><br>
            Stad: <?= $row["city"] ?><br>
            Epost adress: <?= $row["email"] ?><br>
            Årslön: <?= $row["salary"] ?><br>
            Profilbeskrivning: <?= $row["text"] ?><br>
            Preferens: <?= output_preference($row["preference"]); ?>
        </p>
    <?php endif; ?>
</article>