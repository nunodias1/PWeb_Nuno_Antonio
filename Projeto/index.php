<?php
// Inclui o arquivo que contém funções de acesso à base de dados
include 'model/acessobd.php';
// Vai buscar o nome de utilizador da sessão
 $user = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sneaker News and Releases</title>
</head>

<body>
    <header>
        <h1><img src="logo.png"></h1>
            <div class="user-info">
                <?php echo "<span>{$_SESSION['username']}</span>"; ?>
                <a href="logout.php" class="logout-btn">Logout</a>
             </div>
    </header>

    <nav>
        <ul>
            <li><a href="#latest-releases">Latest Releases</a></li>
            <li><a href="#sneaker-reviews">Sneaker Reviews</a></li>
            <li><a href="#history-culture">History and Culture</a></li>
            <li><a href="#sneaker-shopping">Sneaker Shopping</a></li>
        </ul>
    </nav>

    <section id="history-culture">
        <h2>History and Culture</h2>

        <div class="brand">
            <h3><img src="nike.png" alt="Nike" width="100px"></h3>
            <p>Nike, Inc., founded in 1964 by Bill Bowerman and Phil Knight as Blue Ribbon Sports and later named after the Greek goddess of victory, revolutionized athletic footwear with the introduction of Air technology. The partnership with basketball legend Michael Jordan in 1984 led to the creation of the iconic Air Jordan line, which transcended sports to become a cultural phenomenon. Nike has since become a global leader in sports apparel, known for its innovative products and influential marketing.</p>
        </div>

        <div class="brand">
            <h3><img src="adidas.png" alt="Adidas" width="100px"></h3>
            <p>Adidas, established in 1949 by Adolf Dassler, is a German multinational renowned for designing and manufacturing sports shoes, clothing, and accessories. Famed for its three stripes, Adidas has been a major player in the sports industry, known for its innovation and collaborations with top athletes and teams. From the creation of the first screw-in studs to partnerships with icons like Lionel Messi, Adidas continues to be a prominent name in sports and lifestyle fashion.</p>
        </div>

        <!-- Add more brands and their histories as needed -->
    </section>

    <section id="latest-releases" class="latest-releases">
        <h2>Latest Releases</h2>

        <div class="productlr">
            <div class="product-image">
                <img src="airforce1oilgreen.png" alt="Nike Air Max 1">
            </div>
            <div class="product-info">
                <h3>Nike Air Force 1 Oil Green</h3>
                <div class="product-info-item">
                    <div class="info-label"><b>Brand:</b> Nike</div>
                </div>
                <div class="product-info-item">
                    <div class="info-label"><b>Release Date:</b> January 9, 2024</div>
                </div>
                <div class="product-info-item">
                    <div class="info-label"><b>Price:</b> $150</div>
                </div>
            </div>
        </div>

        <div class="productlr">
            <div class="product-image">
                <img src="nikesbdunklowpro.png" alt="Nike SB Dunk Low Pro Deep Royal Blue and Vintage Green">
            </div>
            <div class="product-info">
                <h3>Nike SB Dunk Low </h3>
                <div class="product-info-item">
                    <div class="info-label"><b>Brand:</b> Nike</div>
                </div>
                <div class="product-info-item">
                    <div class="info-label"><b>Release Date:</b> January 13, 2024</div>
                </div>
                <div class="product-info-item">
                    <div class="info-label"><b>Price:</b> $130</div>
                </div>
            </div>
        </div>

        <div class="productlr">
            <div class="product-image">
                <img src="airjordan4.png" alt="Nike SB Dunk Low Pro Deep Royal Blue and Vintage Green">
            </div>
            <div class="product-info">
                <h3>Nike Air Jordan 3 Midnight Navy </h3>
                <div class="product-info-item">
                    <div class="info-label"><b>Brand:</b> Nike</div>
                </div>
                <div class="product-info-item">
                    <div class="info-label"><b>Release Date:</b> January 13, 2024</div>
                </div>
                <div class="product-info-item">
                <div class="info-label"><b>Price:</b> $220</div>
                </div>
            </div>
        </div>
    </section>
    <?php


// Vai buscar o nome de utilizador da sessão
$user = isset($_SESSION['username']) ? $_SESSION['username'] : null;

// Verifica se o formulário de comentário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $sneaker_id = $_POST['sneaker_id'];
    $comentario = trim($_POST['comment']);

    if (empty($comentario)) {
        echo "<script>alert('O comentário não pode estar vazio.');</script>";
    } else {
        if (!verifyComment($user, $sneaker_id)) { // Ajuste para usar a variável $user
            createComment($user, $comentario, $sneaker_id);
        } else {
        }
    }
}

// Obtém a lista de sneakers
$sneakers = getSneakers();

// Obtém a lista de comentários
$comments = getcomments();
?>
    <section id="sneaker-reviews" class="sneaker-reviews">
    <h2>Sneaker Reviews</h2>

    <?php foreach ($sneakers as $sneaker) : ?>
        <div class="sneaker-review-item">
            <div class="sneaker-image">
                <img src="<?php echo $sneaker['imagem']; ?>" alt="<?php echo $sneaker['nome']; ?>">
            </div>
            <div class="sneaker-content">
                <h3 class="sneaker-title"><?php echo $sneaker['nome']; ?></h3>
                <div class="comment-form">
                    <form method="POST" action="">
                        <input type="hidden" name="sneaker_id" value="<?php echo $sneaker['sneaker_id']; ?>">
                        <textarea name="comment" placeholder="Adicione um comentário"></textarea>
                        <button type="submit">Comentar</button>
                    </form>
                </div>
                <div class="existing-comments">
                    <?php foreach ($comments as $comment) : ?>
                        <?php if ($comment['sneaker_id'] == $sneaker['sneaker_id']) : ?>
                            <div class="comment">
                                <strong><?php echo $comment['username']; ?>:</strong>
                                <p><?php echo $comment['comentario']; ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    
</section>


    <section id="sneaker-shopping">
        <h2>Sneaker Shopping</h2>

        <div class="product-row">
            <div class="product">
                <img src="https://images.stockx.com/360/Nike-Air-Max-1-Travis-Scott-Baroque-Brown/Images/Nike-Air-Max-1-Travis-Scott-Baroque-Brown/Lv2/img01.jpg?fm=avif&auto=compress&w=576&dpr=1&updated_at=1645099992&h=384&q=57" alt="Nike Air Max 1">
                <h3>Nike Air Max 1 Travis Scott</h3>
                <div class="purchase-options">
                    <a href="https://stockx.com/nike-air-max-1-travis-scott-baroque-brown" target="_blank">
                        <img src="stockx.png" alt="StockX">
                        <p>Price: $150</p>
                    </a>
                    <a href="https://www.nike.com/pt/launch/notfound target="_blank">
                        <img src="nike.png" alt="Nike">
                        <p>Price: $155</p>
                    </a>
                    <a href="https://www.klekt.com/product/air-max-1-x-travis-scott-cactus-jack-baroque-brown-2022" target="_blank">
                        <img src="https://i0.wp.com/undercoverbrothers.com/wp-content/uploads/2019/07/klekt-logo.png?w=517&ssl=1" alt="Klekt">
                        <p>Price: $148</p>
                    </a>
                </div>
            </div>
            <div class="product">
                <img src="https://images.stockx.com/360/Air-Jordan-4-Retro-SB-Pine-Green/Images/Air-Jordan-4-Retro-SB-Pine-Green/Lv2/img01.jpg?fm=avif&auto=compress&w=576&dpr=1&updated_at=1678350115&h=384&q=57" alt="Nike Air Max 1">
                <h3>Nike Air Jordan 4 SB Pine Green</h3>
                <div class="purchase-options">
                    <a href="https://stockx.com/air-jordan-4-retro-sb-pine-green" target="_blank">
                        <img src="stockx.png" alt="StockX">
                        <p>Price: $150</p>
                    </a>
                    <a href="https://www.nike.com/id/launch/t/nike-sb-air-jordan-4-pine-green" target="_blank">
                        <img src="nike.png" alt="Nike">
                        <p>Price: $155</p>
                    </a>
                    <a href="https://www.klekt.com/product/4-pine-green-2023" target="_blank">
                        <img src="https://i0.wp.com/undercoverbrothers.com/wp-content/uploads/2019/07/klekt-logo.png?w=517&ssl=1" alt="Klekt">
                        <p>Price: $148</p>
                    </a>
                </div>
            </div>
            <div class="product">
                <img src="https://images.stockx.com/360/Air-Jordan-1-Retro-High-OG-Washed-Black/Images/Air-Jordan-1-Retro-High-OG-Washed-Black/Lv2/img01.jpg?fm=avif&auto=compress&w=576&dpr=1&updated_at=1686248226&h=384&q=57" alt="Nike Air Max 1">
                <h3>Nike Air Jordan 1 Retro High OG Washed Black</h3>
                <div class="purchase-options">
                    <a href="https://stockx.com/air-jordan-1-retro-high-og-washed-black" target="_blank">
                        <img src="stockx.png" alt="StockX">
                        <p>Price: $150</p>
                    </a>
                    <a href="https://www.nike.com/pt/launch/notfound" target="_blank">
                        <img src="nike.png" alt="Nike">
                        <p>Price: $155</p>
                    </a>
                    <a href="https://www.klekt.com/product/jordan-1-high-black-washed-2023" target="_blank">
                        <img src="https://i0.wp.com/undercoverbrothers.com/wp-content/uploads/2019/07/klekt-logo.png?w=517&ssl=1" alt="Klekt">
                        <p>Price: $148</p>
                    </a>
                </div>
            </div>

            <!-- Add more products with similar structure as needed -->
        </div>
    </section>
    

</body>

</html>
