<HEADER>
  <A href="/" class="logo"><IMG src="pic/header/teapot.png" alt="Логотип"></A>
  <!-- Кнопка -->
  <div class="css-modal-target-container">
    <A href="basket.php" rel="nofollow"><IMG class="bas" src="pic/header/basket.png" alt="Корзина"></A>
    <?php
    if (!empty($_SESSION['user'])) {
    ?>
      <A class="css-modal-open" href="profile.php" rel="nofollow"><IMG src="pic/header/user.png" alt="Профиль"></A>
    <?php
    } else {
    ?>
      <A class="css-modal-open" href="#css-modal-target" rel="nofollow"><IMG src="pic/header/user.png" alt="Профиль"></A>
    <?php
    }
    ?>
  </div>
  <!-- Модальное окно -->
  <div class="css-modal-target" id="css-modal-target">
    <div class="cmt">
      <FORM action="php/entry.php" method="post">
        <IMG src="pic/header/teapot.png" alt="Логотип">
        <H2>Чайный дом</H2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Пароль" required>
        <button type="submit">Войти</button>
        <?php
        if (@$_SESSION['message']) {
          echo '<p> ' . $_SESSION['message'] . ' </p>';
        }
        unset($_SESSION['message']);
        ?>
        <P>Ещё не зарегистрированны?</P>
        <A class="css-modal-open" href="#css-modal-target1" rel="nofollow">Сделайте это сейчас!</A>
      </FORM>
    </div>
    <A href="#close" class="css-modal-close"></A>
  </div>
  <div class="css-modal-target" id="css-modal-target1">
    <div class="cmt">
      <FORM action="php/registr.php" method="post">
        <IMG src="pic/header/teapot.png" alt="Логотип">
        <H2>Регистрация</H2>
        <input type="text" name="surname" placeholder="Фамилия" required>
        <input type="text" name="name" placeholder="Имя" required>
        <input type="text" name="fatherhood" placeholder="Отчество" required>
        <input type="email" name="email" placeholder="Введите вашу почту" required>
        <input type="password" name="password" placeholder="Введите пароль" required>
        <input type="password" name="password_confirm" placeholder="Подтвердите пароль" required>
        <input type="text" name="city" placeholder="Город" required>
        <input type="text" name="address" placeholder="Адрес" required>
        <input type="text" name="index" placeholder="Почтовый индекс" required>
        <button type="submit">Зарегистрироваться</button>
        <?php
        if (@$_SESSION['message1']) {
          echo '<p> ' . $_SESSION['message1'] . ' </p>';
        }
        unset($_SESSION['message1']);
        ?>
      </FORM>
    </div>
    <A href="#close" class="css-modal-close"></A>
  </div>