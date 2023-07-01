<?php
session_start();
if (isset($_POST["add_to_cart"])) {
  if (isset($_SESSION["shopping_cart"])) {
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    if (!in_array($_GET["id"], $item_array_id)) {
      $count = count($_SESSION["shopping_cart"]);
      $item_array = array(
        'item_id'               =>     $_GET["id"],
        'item_name'               =>     $_POST["hidden_name"],
        'item_price'          =>     $_POST["hidden_price"],
        'item_img'          =>     $_POST["hidden_img"]
      );
      $_SESSION["shopping_cart"][$count] = $item_array;
    }
  } else {
    $item_array = array(
      'item_id'               =>     $_GET["id"],
      'item_name'               =>     $_POST["hidden_name"],
      'item_price'          =>     $_POST["hidden_price"],
      'item_img'          =>     $_POST["hidden_img"]
    );
    $_SESSION["shopping_cart"][0] = $item_array;
  }
}
if (isset($_GET["action"])) {
  if ($_GET["action"] == "delete") {
    foreach ($_SESSION["shopping_cart"] as $keys => $values) {
      if ($values["item_id"] == $_GET["id"]) {
        unset($_SESSION["shopping_cart"][$keys]);
      }
    }
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML lang="ru">

<HEAD>
  <META http-equiv="content-type" content="text/html; charset=utf-8">
  <META name="Главная страница" content="Крылов Алексей">
  <META name="viewport" content="width=device-width, initial-scale=1.0">
  <META name="description" content="На нашей странице вы найдёте широкий ассортимент чайной посуды, 
  изготовленной в единственном экземпляре и придуманной нашими мастерами" />
  <META name="keywords" content="заказать, купить, чайную посуду, в Москве, онлайн, на заказ, в единственном экземпляре, на подарок" />
  <LINK rel="preload" href="css/main.css" as="style" />
  <LINK rel="stylesheet" type="text/css" href="css/main.css">
  <LINK rel="shortcut icon" href="pic/header/teapot.ico" type="image/x-icon">
  <LINK rel="canonical" href="http://alex228323.beget.tech/index.php">
  <LINK rel="dns-prefetch" href="http://mc.yandex.ru"/>
  <TITLE>Чайный дом: уникальная чайная утварь Москвы, только у нас
  </TITLE>
</HEAD>

<BODY>
  <?php
  require_once 'header.php';
  require_once 'php/connect.php';
  ?>
  <!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(92701746, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/92701746" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
  <!-- Модальное окно с регистрацией/авторизацией -->
  <NAV>
    <ul class="topmenu">
      <li><A>Главная</A></li>
      <li><A href="orders.php">Заказы</A></li>
      <li>
        <A class="down">Категории</a>
        <ul class="submenu">
          <!-- Раскрывающийся список с выбором категории -->
          <li><A href="teapots.php">Чайники</A></li>
          <li><A href="cups.php">Чашки</A></li>
          <li><A href="teaset.php">Чайный сервиз</A></li>
      </li>
    </ul>
    </ul>
  </NAV>
  </HEADER>
  <div class="btn-up btn-up_hide"></div>
  <ARTICLE>
    <div id="baner">
    <SECTION class="banner">
      <H1 style="
    font-family: 'Raleway', sans-serif;
    font-size: 40px;
    min-height: 2em;
    margin-top: 0px;
    margin-bottom: 0px;
    text-align: left;
">
        Большая распродажа! <br>
        Скидки до 50%
      </H1>
      <button onclick="window.location.href='#down'" id="button"><span>Подробнее</span></button>
    </SECTION>
    </div>
  </ARTICLE>
  <!-- Якорь, который открывает часть страницы с акциями -->
  <H2>Новинки</H2>
  <div class="wrapper">
    <!-- Контент -->
    <div class="slider">
      <div class="slider__item filter">
        <?php
        $query = "SELECT * FROM `products` where Id_products='4'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <FORM method="post" action="teapots.php?action=add&id=<?php echo $row["Id_products"]; ?>">
              <FIGURE>
                <div>
                  <A href="tovar.php?id=<?php echo $row["Id_products"]; ?>"><IMG src="<?php echo $row["img"]; ?>" class="tovar" alt="Чайник" width="300px" height="300px"></A>
                  <input type="submit" class="basket" name="add_to_cart" value="" />
                </div>
                <FIGCAPTION>
                  <H2><?php echo $row["name"]; ?><br></H2>
                  <?php if ($row['promo'] > 0) {
                    echo "<span class='ak'>" . $row['price'] . "&#8381" . "</span>" . "<span>" . $row['promo'] . "&#8381" . "</span>";
                  } else {
                    echo "<span>" . $row['price'] . "&#8381" . "</span>";
                  }
                  ?>
                  <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                  <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                  <input type="hidden" name="hidden_img" value="<?php echo $row["img"]; ?>" />
                </FIGCAPTION>
              </FIGURE>
            </FORM>
        <?php
          }
        }
        ?>
      </div>
      <div class="slider__item">
        <?php
        $query = "SELECT * FROM `products` where Id_products='15'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <FORM method="post" action="teapots.php?action=add&id=<?php echo $row["Id_products"]; ?>">
              <FIGURE>
                <div>
                  <A href="tovar.php?id=<?php echo $row["Id_products"]; ?>"><IMG src="<?php echo $row["img"]; ?>" class="tovar" alt="Чайник" width="300px" height="300px"></A>
                  <input type="submit" class="basket" name="add_to_cart" value="" />
                </div>
                <FIGCAPTION>
                  <H2><?php echo $row["name"]; ?><br></H2>
                  <?php if ($row['promo'] > 0) {
                    echo "<span class='ak'>" . $row['price'] . "&#8381" . "</span>" . "<span>" . $row['promo'] . "&#8381" . "</span>";
                  } else {
                    echo "<span>" . $row['price'] . "&#8381" . "</span>";
                  }
                  ?>
                  <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                  <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                  <input type="hidden" name="hidden_img" value="<?php echo $row["img"]; ?>" />
                </FIGCAPTION>
              </FIGURE>
            </FORM>
        <?php
          }
        }
        ?>
      </div>
      <div class="slider__item filter">
        <?php
        $query = "SELECT * FROM `products` where Id_products='7'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <FORM method="post" action="teapots.php?action=add&id=<?php echo $row["Id_products"]; ?>">
              <FIGURE>
                <div>
                  <A href="tovar.php?id=<?php echo $row["Id_products"]; ?>"><IMG src="<?php echo $row["img"]; ?>" class="tovar" alt="Чайник" width="300px" height="300px"></A>
                  <input type="submit" class="basket" name="add_to_cart" value="" />
                </div>
                <FIGCAPTION>
                  <H2><?php echo $row["name"]; ?><br></H2>
                  <?php if ($row['promo'] > 0) {
                    echo "<span class='ak'>" . $row['price'] . "&#8381" . "</span>" . "<span>" . $row['promo'] . "&#8381" . "</span>";
                  } else {
                    echo "<span>" . $row['price'] . "&#8381" . "</span>";
                  }
                  ?>
                  <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                  <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                  <input type="hidden" name="hidden_img" value="<?php echo $row["img"]; ?>" />
                </FIGCAPTION>
              </FIGURE>
            </FORM>
        <?php
          }
        }
        ?>
      </div>
      <div class="slider__item">
        <?php
        $query = "SELECT * FROM `products` where Id_products='12'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <FORM method="post" action="teapots.php?action=add&id=<?php echo $row["Id_products"]; ?>">
              <FIGURE>
                <div>
                  <A href="tovar.php?id=<?php echo $row["Id_products"]; ?>"><IMG src="<?php echo $row["img"]; ?>" class="tovar" alt="Чайник" width="300px" height="300px"></A>
                  <input type="submit" class="basket" name="add_to_cart" value="" />
                </div>
                <FIGCAPTION>
                  <H2><?php echo $row["name"]; ?><br></H2>
                  <?php if ($row['promo'] > 0) {
                    echo "<span class='ak'>" . $row['price'] . "&#8381" . "</span>" . "<span>" . $row['promo'] . "&#8381" . "</span>";
                  } else {
                    echo "<span>" . $row['price'] . "&#8381" . "</span>";
                  }
                  ?>
                  <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                  <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                  <input type="hidden" name="hidden_img" value="<?php echo $row["img"]; ?>" />
                </FIGCAPTION>
              </FIGURE>
            </FORM>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
  <H2 id="down">Акции</H2>
  <div class="wrapper">
    <!-- Контент -->
    <div class="slider">
      <div class="slider__item filter">
        <?php
        $query = "SELECT * FROM `products` where Id_products='1'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <FORM method="post" action="teapots.php?action=add&id=<?php echo $row["Id_products"]; ?>">
              <FIGURE>
                <div>
                  <A href="tovar.php?id=<?php echo $row["Id_products"]; ?>"><IMG src="<?php echo $row["img"]; ?>" class="tovar" alt="Чайник" width="300px" height="300px"></A>
                  <input type="submit" class="basket" name="add_to_cart" value="" />
                </div>
                <FIGCAPTION>
                  <H2><?php echo $row["name"]; ?><br></H2>
                  <?php if ($row['promo'] > 0) {
                    echo "<span class='ak'>" . $row['price'] . "&#8381" . "</span>" . "<span>" . $row['promo'] . "&#8381" . "</span>";
                  } else {
                    echo "<span>" . $row['price'] . "&#8381" . "</span>";
                  }
                  ?>
                  <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                  <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                  <input type="hidden" name="hidden_img" value="<?php echo $row["img"]; ?>" />
                </FIGCAPTION>
              </FIGURE>
            </FORM>
        <?php
          }
        }
        ?>
      </div>
      <div class="slider__item">
        <?php
        $query = "SELECT * FROM `products` where Id_products='5'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <FORM method="post" action="teapots.php?action=add&id=<?php echo $row["Id_products"]; ?>">
              <FIGURE>
                <div>
                  <A href="tovar.php?id=<?php echo $row["Id_products"]; ?>"><IMG src="<?php echo $row["img"]; ?>" class="tovar" alt="Чайник" width="300px" height="300px"></A>
                  <input type="submit" class="basket" name="add_to_cart" value="" />
                </div>
                <FIGCAPTION>
                  <H2><?php echo $row["name"]; ?><br></H2>
                  <?php if ($row['promo'] > 0) {
                    echo "<span class='ak'>" . $row['price'] . "&#8381" . "</span>" . "<span>" . $row['promo'] . "&#8381" . "</span>";
                  } else {
                    echo "<span>" . $row['price'] . "&#8381" . "</span>";
                  }
                  ?>
                  <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                  <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                  <input type="hidden" name="hidden_img" value="<?php echo $row["img"]; ?>" />
                </FIGCAPTION>
              </FIGURE>
            </FORM>
        <?php
          }
        }
        ?>
      </div>
      <div class="slider__item filter">
        <?php
        $query = "SELECT * FROM `products` where Id_products='6'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <FORM method="post" action="teapots.php?action=add&id=<?php echo $row["Id_products"]; ?>">
              <FIGURE>
                <div>
                  <A href="tovar.php?id=<?php echo $row["Id_products"]; ?>"><IMG src="<?php echo $row["img"]; ?>" class="tovar" alt="Чайник" width="300px" height="300px"></A>
                  <input type="submit" class="basket" name="add_to_cart" value="" />
                </div>
                <FIGCAPTION>
                  <H2><?php echo $row["name"]; ?><br></H2>
                  <?php if ($row['promo'] > 0) {
                    echo "<span class='ak'>" . $row['price'] . "&#8381" . "</span>" . "<span>" . $row['promo'] . "&#8381" . "</span>";
                  } else {
                    echo "<span>" . $row['price'] . "&#8381" . "</span>";
                  }
                  ?>
                  <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                  <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                  <input type="hidden" name="hidden_img" value="<?php echo $row["img"]; ?>" />
                </FIGCAPTION>
              </FIGURE>
            </FORM>
        <?php
          }
        }
        ?>
      </div>
      <div class="slider__item">
        <?php
        $query = "SELECT * FROM `products` where Id_products='8'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <FORM method="post" action="teapots.php?action=add&id=<?php echo $row["Id_products"]; ?>">
              <FIGURE>
                <div>
                  <A href="tovar.php?id=<?php echo $row["Id_products"]; ?>"><IMG src="<?php echo $row["img"]; ?>" class="tovar" alt="Чайник" width="300px" height="300px"></A>
                  <input type="submit" class="basket" name="add_to_cart" value="" />
                </div>
                <FIGCAPTION>
                  <H2><?php echo $row["name"]; ?><br></H2>
                  <?php if ($row['promo'] > 0) {
                    echo "<span class='ak'>" . $row['price'] . "&#8381" . "</span>" . "<span>" . $row['promo'] . "&#8381" . "</span>";
                  } else {
                    echo "<span>" . $row['price'] . "&#8381" . "</span>";
                  }
                  ?>
                  <input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>" />
                  <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>" />
                  <input type="hidden" name="hidden_img" value="<?php echo $row["img"]; ?>" />
                </FIGCAPTION>
              </FIGURE>
            </FORM>
        <?php
          }
        }
        ?>
      </div>
    </div>
  </div>
  
  <H2>Наши партнёры</H2>
  <div class="partn">
  <A href="http://cumen.dimatash23.beget.tech/"><IMG src="http://cumen.dimatash23.beget.tech/img/logo.png" class="logop" alt="Cumen"></A>
  <A href="http://m95045lu.beget.tech/"><IMG src="http://cumen.dimatash23.beget.tech/img/koresha/logo-cosmobeaute.png" class="logop" alt="Cosmo BEAUTE"></A>
  <A href="http://asca.test-handyhost.ru/"><IMG src="http://cumen.dimatash23.beget.tech/img/koresha/logo-asca.png" class="logop" alt="asca"></A>
  </div>
  <!-- Подключаем jQuery -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" defer></script>
  <!-- Подключаем слайдер Slick -->
  <script src="js/slick.min.js" defer></script>
  <!-- Подключаем файл скриптов -->
  <script src="js/script.js" defer></script>
  <script src="js/up.js" defer></script>
  </MAIN>
  <?php
  require_once 'footer.php';
  ?>
</BODY>

</HTML>