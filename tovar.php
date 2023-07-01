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
require_once 'php/connect.php';
$id = $_GET['id'];

/*
       * Делаем выборку строки с полученным ID выше
       */

$products = mysqli_query($connect, "SELECT * FROM `products` WHERE `Id_products` = '$id'");

/*
       * Преобразовывем полученные данные в нормальный массив
       * Используя функцию mysqli_fetch_assoc массив будет иметь ключи равные названиям столбцов в таблице
       */

$products = mysqli_fetch_assoc($products);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML lang="ru">

<HEAD>
  <META http-equiv="content-type" content="text/html; charset=utf-8">
  <META name="Товар" content="Крылов Алексей">
  <META name="viewport" content="width=device-width, initial-scale=1.0">
  <META name="description" content="" />
  <LINK rel="preload" href="css/tovar.css" as="style" />
  <LINK rel="stylesheet" type="text/css" href="css/tovar.css">
  <LINK rel="shortcut icon" href="pic/header/teapot.ico" type="image/x-icon">
  <TITLE><?= $products['name'] ?>
  </TITLE>
</HEAD>

<BODY>
  <?php
  require_once 'header.php';

  ?>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date(); for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }} k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(92701746, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/92701746" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
  <NAV>
    <ul class="topmenu">
      <li><A href="/">Главная</A></li>
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
  <FORM method="post" action="tovar.php?action=add&id=<?php echo $products['Id_products'] ?>">
    <FIGURE>
      <IMG src="<?= $products['img'] ?>" class="tovar" alt="Товар">
      <FIGCAPTION>
        <H1><?= $products['name'] ?><br></H1>
        <?php if ($products['promo'] > 0) {
          echo "<span class='ak'>" . $products['price'] . "&#8381" . "</span>" . "<span>" . $products['promo'] . "&#8381" . "</span>";
        } else {
          echo "<span>" . $products['price'] . "&#8381" . "</span>";
        }
        ?>
        <input type="hidden" name="hidden_name" value="<?php echo $products['name'] ?>" />
        <input type="hidden" name="hidden_price" value="<?php if ($products['promo'] > 0) {
                                                          echo $products['promo'];
                                                        } else {
                                                          echo $products["price"];
                                                        } ?>" />
        <input type="hidden" name="hidden_img" value="<?php echo $products["img"]; ?>" />
        <H2>Описание</H2>
        <P>
          <?= $products['description'] ?>
        </P>
        <H2>Подробные характеристики</H2>
        <P>
          <?= $products['specification'] ?>
        </P>
        <input class="basket" type="submit" name="add_to_cart" value="Добавить в корзину" />
      </FIGCAPTION>
    </FIGURE>
  </FORM>
  </MAIN>
  <?php
  require_once 'footer.php';
  ?>
</BODY>

</HTML>