<article>
    <h2>Annonserna</h2>
    
    <?php
        $sql = "SELECT fullname, email, city, text, salary, preference FROM users LIMIT 5";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    ?>
    <div class="ads-grid">
        <?php foreach ($stmt->fetchAll() as $user) : ?>
            <div class="ad-in-grid">
                <h4><?= $user["fullname"]?></h4>
                <p class="user-details">
                    Från <?= $user["city"]?>,
                    intresserad av <?= output_preference($user["preference"])?><?php if ($user["salary"] != NULL) :?>, årslön <?= $user["salary"]?><?php endif; ?>.
                </p>
                <?php if ($user["text"] != NULL) :?>
                    <div class="text-in-ad">
                        "<?= $user["text"]?>"
                    </div>
                <?php endif; ?>
                <?php if (!empty($_SESSION["username"])) :?>
                    <p class="actions">
                        <a href="mailto:<?= $user["email"]?>"><img src="../media/email.png" alt="Skicka ett mejl"></a>
                    </p>
                <?php else: ?>
                    <p class="actions">
                        <img src="../media/email-inactive.png" alt="Logga in för att kunna skicka ett mejl">
                    </p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    

</article>