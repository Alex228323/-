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
  <META name="Чайники" content="Крылов Алексей">
  <META name="viewport" content="width=device-width, initial-scale=1.0">
  <META name="description" content="Уникальные чайники сделанные в единственном экземпляре и доступные по онлайн заказу из Москвы" />
  <META name="keywords" content="чайник, в подарок, по акции, купить, заказать, онлайн, на заказ, в Москве" />
  <LINK rel="stylesheet" type="text/css" href="css/main3.css">
  <LINK rel="preload" href="css/main3.css" as="style" />
  <LINK rel="shortcut icon" href="pic/header/teapot.ico" type="image/x-icon">
  <LINK rel="dns-prefetch" href="http://mc.yandex.ru"/>
  <TITLE>Уникальные чайники от Чайного дома: единственная в своём роде чайная утварь в Москве
  </TITLE>
</HEAD>

<BODY>
  <?php
  require_once 'header.php';
  require_once 'php/connect.php';
  ?>
  <NAV>
    <ul class="topmenu">
      <li><A href="/">Главная</A></li>
      <li><A href="orders.php">Заказы</A></li>
      <li>
        <A class="down">Категории</a>
        <ul class="submenu">
          <!-- Раскрывающийся список с выбором категории -->
          <li><A>Чайники</A></li>
          <li><A href="cups.php">Чашки</A></li>
          <li><A href="teaset.php">Чайный сервиз</A></li>
      </li>
    </ul>
    </ul>
  </NAV>
  </HEADER>
  <MAIN>
    <div class="btn-up btn-up_hide"></div>
    <H1>Чайники</H1>
    <form id="search">
      <input type="text" name="" id="find" placeholder="Найти..." onkeyup="search()">
    </form>
    <div class="tabw">
      <div class="blok">
        <?php
        $query = "SELECT * FROM `products` where category='Чайник'";
        $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_array($result)) {
        ?>
            <div class="blok1">
              <FORM id="form" method="post" action="teapots.php?action=add&id=<?php echo $row["Id_products"]; ?>">
                <FIGURE>
                  <div>
                    <A href="tovar.php?id=<?php echo $row["Id_products"]; ?>"><IMG src="<?php echo $row["img"]; ?>" class="tovar" alt="Чайник"></A>
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
                    <input type="hidden" name="hidden_price" value="<?php if ($row['promo'] > 0) {
                                                                      echo $row['promo'];
                                                                    } else {
                                                                      echo $row["price"];
                                                                    } ?>" />
                    <input type="hidden" name="hidden_img" value="<?php echo $row["img"]; ?>" />
                  </FIGCAPTION>
                </FIGURE>
              </FORM>
            </div>
        <?php
          }
        }
        ?>
      </div>
    </div>
    <script src="js/up.js" defer></script>
    <script src="js/search.js" defer></script>
  </MAIN>
  <?php
  require_once 'footer.php';
  ?>
</BODY>

</HTML>