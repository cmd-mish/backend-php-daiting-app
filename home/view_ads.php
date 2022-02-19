<article>
    <h2>Annonserna</h2>
    <p>Här kommer datan</p>
    
    <?php
        $sql = "SELECT fullname, email, city, text, salary, preference FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    ?>
    <div class="ads-grid">
        <?php foreach ($stmt->fetchAll() as $user) : ?>
            <div class="ad-in-grid">
                <h4><?= $user["fullname"]?></h4>
                <p class="user-details">
                    Från <?= $user["city"]?>,
                    intresserad av  <?= output_preference($user["preference"]) ?>,
                    årslön <?= $user["salary"]?>.
                </p>
                <p>
                    <?= $user["text"]?>
                </p>

                <?php if (!empty($_SESSION["username"])) :?>
                <p>
                    <?= $user["email"]?>
                </p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    

</article>