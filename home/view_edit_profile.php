<article>
    <h2>Ändra din profil</h2>

    <?php
    $username = $_SESSION["username"];

    $sql = "SELECT fullname, city, email, salary, text, preference FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    ?>
    <?php if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <form action="profile.php?page=edit" method="POST">
            Fullständiga namn: <input type="text" name="fullname" value="<?= $row["fullname"] ?>"><br>
            Stad: <input type="text" name="city" value="<?= $row["city"] ?>"><br>
            Epost adress: <input type="text" name="email" value="<?= $row["email"] ?>"><br>
            Årslön: <input type="number" name="salary" value="<?= $row["salary"] ?>"><br>
            Berätta om dig: <textarea name="ad-text"><?= $row["text"] ?></textarea><br>
            Preferens: <input type="radio" id="men" name="preference" value="1" <?php if ($row["preference"] == 1) :?> checked <?php endif; ?>><label for="men">Män</label>
            <input type="radio" id="women" name="preference" value="2" <?php if ($row["preference"] == 2) :?> checked <?php endif; ?>><label for="women">Kvinnor</label>
            <input type="radio" id="both" name="preference" value="3" <?php if ($row["preference"] == 3) :?> checked <?php endif; ?>><label for="both">Båda</label>
            <input type="radio" id="other" name="preference" value="4" <?php if ($row["preference"] == 4) :?> checked <?php endif; ?>><label for="other">Annat</label>
            <input type="radio" id="all" name="preference" value="5" <?php if ($row["preference"] == 5) :?> checked <?php endif; ?>><label for="all">Alla</label><br>
        <input type="submit" value="Spara">
    </form>
    <?php endif; ?>
</article>

<?php
    if (!empty($_REQUEST["fullname"]) && !empty($_REQUEST["city"]) &&
        !empty($_REQUEST["email"]) && !empty($_REQUEST["salary"]) &&
        !empty($_REQUEST["ad-text"]) && !empty($_REQUEST["preference"])) {

        $fullname = test_input($_REQUEST["fullname"]);
        $city = test_input($_REQUEST["city"]);
        $email = test_input($_REQUEST["email"]);
        $salary = test_input($_REQUEST["salary"]);
        $text = test_input($_REQUEST["ad-text"]);
        $preference = test_input($_REQUEST["preference"]);

        $sql = "UPDATE users SET fullname = ?, city = ?, email = ?, salary = ?, text = ?, preference = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute([$fullname, $city, $email, $salary, $text, $preference, $username])) {
            print("Success!");
            header("Refresh:2; url=./profile.php");
        } else {
            print("Nåt gick fel!");
        }
    } else {
        print("Alla fält måste vara fyllda!");
    }

?>