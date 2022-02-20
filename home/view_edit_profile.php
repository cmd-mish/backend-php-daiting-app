<article>
    <h2>Ändra dina profiluppgifter</h2>
    <p class="edit-profile-link"><a href="profile.php">Tillbaka</a></p>
    <?php
    $username = $_SESSION["username"];

    $sql = "SELECT fullname, city, email, salary, text, preference FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);
    ?>
    <?php if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <form action="profile.php?page=edit" method="POST">
            <label for="fullname">Fullständiga namn<span class="obligatory">*</span></label><br><input type="text" name="fullname" id="fullname" value="<?= $row["fullname"] ?>"><br>
            <label for="city">Stad<span class="obligatory">*</span></label><br><input type="text" name="city" id="city" value="<?= $row["city"] ?>"><br>
            <label for="email">E-post adress<span class="obligatory">*</span></label><br><input type="text" name="email" id="email" value="<?= $row["email"] ?>"><br>
            <label for="salary">Årslön</label><br><input type="number" name="salary" id="salary" value="<?= $row["salary"] ?>">&euro;<br>
            <label for="ad-text">Berätta om dig</label><br><textarea name="ad-text" id="ad-text" rows="5" cols="50"><?= $row["text"] ?></textarea><br>
            Preferens<span class="obligatory">*</span><input type="radio" id="men" name="preference" value="1" <?php if ($row["preference"] == 1) :?> checked <?php endif; ?>><label for="men">Män</label>
            <input type="radio" id="women" name="preference" value="2" <?php if ($row["preference"] == 2) :?> checked <?php endif; ?>><label for="women">Kvinnor</label>
            <input type="radio" id="both" name="preference" value="3" <?php if ($row["preference"] == 3) :?> checked <?php endif; ?>><label for="both">Båda</label>
            <input type="radio" id="other" name="preference" value="4" <?php if ($row["preference"] == 4) :?> checked <?php endif; ?>><label for="other">Annat</label>
            <input type="radio" id="all" name="preference" value="5" <?php if ($row["preference"] == 5) :?> checked <?php endif; ?>><label for="all">Alla</label><br><br>
        <input type="submit" value="Spara">
    </form>
    <br><span class="obligatory">*</span> betyder att fältet är obligatoriskt
    <?php endif; ?>
</article>

<?php
    if (!empty($_REQUEST["fullname"]) && !empty($_REQUEST["city"]) &&
        !empty($_REQUEST["email"]) && !empty($_REQUEST["preference"])) {

        $fullname = test_input($_REQUEST["fullname"]);
        $city = test_input($_REQUEST["city"]);
        $email = test_input($_REQUEST["email"]);
        $salary = test_input($_REQUEST["salary"]);
        if (empty($salary)) $salary = NULL;
        $text = test_input($_REQUEST["ad-text"]);
        if (empty($text)) $text = NULL;
        $preference = test_input($_REQUEST["preference"]);

        $sql = "UPDATE users SET fullname = ?, city = ?, email = ?, salary = ?, text = ?, preference = ? WHERE username = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt->execute([$fullname, $city, $email, $salary, $text, $preference, $username])) {
            print("Success!");
            header("Refresh:0; url=./profile.php");
        } else {
            print("Nåt gick fel!");
        }
    }
?>