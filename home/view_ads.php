<?php
    if (empty($_SESSION["ads_limit"])) {
        $_SESSION["ads_limit"] = 5;
    }
    if (empty($_SESSION["sort_by"])) {
        $_SESSION["sort_by"] = "id DESC";
    }
    if (empty($_SESSION["preference"])) {
        $_SESSION["preference"] = "all";
    }

    $ads_limit = $_SESSION["ads_limit"];
    $sort_by = $_SESSION["sort_by"];
    $preference = $_SESSION["preference"];

    if (!empty($_REQUEST["limit-ads"])) {
        $ads_limit = test_input($_REQUEST["limit-ads"]);
        $_SESSION["ads_limit"] = $ads_limit;
    }

    if (!empty($_REQUEST["sort-by"])) {
        $sort_by = test_input($_REQUEST["sort-by"]);
        $_SESSION["sort_by"] = $sort_by;
    }

    if (!empty($_REQUEST["preference"])) {
        $preference = test_input($_REQUEST["preference"]);
        $_SESSION["preference"] = $preference;
    }
?>

<article>
    <h2>Annonserna</h2>
    <p class="ad-filter">
        <form action="index.php" method="post">
            <label for="preference">Visa dem som har denna preferens: </label>
            <select name="preference" id="preference">
                <option value="all" <?php if ($preference == "all") :?> selected <?php endif; ?>>- Alla preferenser -</option>
                <option value="1" <?php if ($preference == "1") :?> selected <?php endif; ?>>Män</option>
                <option value="2" <?php if ($preference == "2") :?> selected <?php endif; ?>>Kvinnor</option>
                <option value="3" <?php if ($preference == "3") :?> selected <?php endif; ?>>Båda</option>
                <option value="4" <?php if ($preference == "4") :?> selected <?php endif; ?>>Annat</option>
                <option value="5" <?php if ($preference == "5") :?> selected <?php endif; ?>>Alla</option>
            </select><br>

            <label for="sort-by">Sortera: </label>
            <select name="sort-by" id="sort-by">
                <option value="id DESC" <?php if ($sort_by == "id DESC") :?> selected <?php endif; ?>>Nyaste</option>
                <option value="id ASC" <?php if ($sort_by == "id ASC") :?> selected <?php endif; ?>>Äldsta</option>
                <option value="salary DESC" <?php if ($sort_by == "salary DESC") :?> selected <?php endif; ?>>Högsta löner</option>
                <option value="salary ASC" <?php if ($sort_by == "salary ASC") :?> selected <?php endif; ?>>Lägsta löner</option>
                <option value="rating DESC" <?php if ($sort_by == "rating DESC") :?> selected <?php endif; ?>>Populäraste</option>
                <option value="rating ASC" <?php if ($sort_by == "rating ASC") :?> selected <?php endif; ?>>Mindre populära</option>
            </select>

            <label for="limit-ads">Maximal antal annonser per sida:</label>
            <select name="limit-ads" id="limit-ads">
                <option value="2" <?php if ($ads_limit == 2) :?> selected <?php endif; ?>>2</option>
                <option value="5" <?php if ($ads_limit == 5) :?> selected <?php endif; ?>>5</option>
                <option value="10" <?php if ($ads_limit == 10) :?> selected <?php endif; ?>>10</option>
                <option value="20" <?php if ($ads_limit == 20) :?> selected <?php endif; ?>>20</option>
                <option value="50" <?php if ($ads_limit == 50) :?> selected <?php endif; ?>>50</option>
            </select>
            <input type="submit" value="OK">
        </form>
    </p>
    <?php
        if ($preference == "all") {
            $sql_preference = "";
        } else {
            $sql_preference = "WHERE preference = $preference";
        }

        $sql = "SELECT id, username, fullname, email, city, text, salary, preference, rating FROM users $sql_preference ORDER BY $sort_by LIMIT $ads_limit";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    ?>
    <div class="ads-grid">
        <?php foreach ($stmt->fetchAll() as $user) : ?>
            <div class="ad-in-grid">
                <h4><?= $user["fullname"]?></h4>
                <p class="user-details">
                    Från <?= $user["city"]?>,
                    intresserad av <?= output_preference($user["preference"])?><?php if ($user["salary"] != NULL) :?>, årslön <?= $user["salary"]?>&euro;<?php endif; ?>, gillat av <?= $user["rating"] ?>.
                </p>
                <?php if (!empty($_SESSION["username"])) :?>
                    <p class="actions">
                        <a href="profile.php?id=<?= $user["id"] ?>"><img src="../media/profile.png" alt="Visa profilsidan"></a>
                        <a href="mailto:<?= $user["email"]?>"><img src="../media/email.png" alt="Skicka ett mejl"></a>
                        <a href="profile.php?id=<?= $user["id"] ?>#comment"><img src="../media/comment.png" alt="Lämna en kommentar"></a>
                    </p>
                <?php else: ?>
                    <p class="actions">
                        <img src="../media/profile-inactive.png" alt="Logga in för att kunna se profilsidan">
                        <img src="../media/email-inactive.png" alt="Logga in för att kunna skicka ett mejl">
                        <img src="../media/comment-inactive.png" alt="Logga in för att kunna lämna en kommentar">
                    </p>
                <?php endif; ?>
                <?php if ($user["text"] != NULL) :?>
                    <div class="text-in-ad">
                        "<?= substr($user["text"], 0, 250)?>"
                    </div>
                <?php endif; ?>

            </div>
        <?php endforeach; ?>
    </div>
    

</article>