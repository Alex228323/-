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
     <META name="viewport" content="width=device-width, initial-scale=1.0">
     <META name="Корзина" content="Крылов Алексей">
     <LINK rel="preload" href="css/main5.css" as="style" />
     <LINK rel="stylesheet" type="text/css" href="css/main5.css">
     <LINK rel="shortcut icon" href="pic/header/teapot.ico" type="image/x-icon">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <TITLE>Корзина</TITLE>
</HEAD>

<BODY>
     <?php
     require_once 'header.php';
     require_once 'php/connect.php';
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
     <div style="clear:both"></div>
     <H1>Корзина</H1>
     <br>
     <div id="center">
     <FORM method="post" action="basket.php?action=add&id=<?php echo $row["Id_products"]; ?>">
          <?php
          if (!empty($_SESSION["shopping_cart"])) {
               $total = 0;
               foreach ($_SESSION["shopping_cart"] as $keys => $values) {
          ?>
                    <div class="zzz1">
                         <A href="tovar.php?id=<?php echo $values["item_id"]; ?>"><IMG src="<?php echo $values["item_img"]; ?>" class="tovar" alt="Чайник"></A>
                         <A class="zzz3" href="tovar.php?id=<?php echo $values["item_id"]; ?>"><?php echo $values["item_name"]; ?></A>
                         <P><?php echo $values["item_price"]; ?>&#8381;</P>
                         <input type="hidden" name="hidden_name" value="<?php echo $row["item_name"]; ?>" />
                         <input type="hidden" name="hidden_price" value="<?php echo $row["item_price"]; ?>" />
                         <input type="hidden" name="hidden_img" value="<?php echo $row["item_img"]; ?>" />
                         <a href="basket.php?action=delete&id=<?php echo $values["item_id"]; ?>" class="zzz2"></a>
                    </div>

               <?php
                    $total = $total + ($values["item_price"]);
               }
               ?>
               <P>Общая стоимость: <?php echo number_format($total, 2); ?>&#8381;</P>

               <input class="zakaz" type="submit" name="add_to_cart" value="Оформить заказ" />

          <?php
          } else {
               echo "<P class='pusto'>" . 'Ваша корзина пуста' . "</P>";
          }

          ?>
     </FORM>
     </div>
     </MAIN>
     <?php
     require_once 'footer.php';
     ?>
</BODY>

</HTML>