const btnUp = {
  el: document.querySelector('.btn-up'),
  show() {
    // удаление у кнопки класса btn-up_hide
    this.el.classList.remove('btn-up_hide');
  },
  hide() {
    // добавление к кнопке класса btn-up_hide
    this.el.classList.add('btn-up_hide');
  },
  addEventListener() {
    // при прокрутке содержимого страницы
    window.addEventListener('scroll', () => {
      // определение величины прокрутки
      const scrollY = window.scrollY || document.documentElement.scrollTop;
      // если страница прокручена больше чем на 400px, то делаем кнопку видимой, иначе скрываем
      scrollY > 200 ? this.show() : this.hide();
    });
    // при нажатии на кнопку .btn-up
    document.querySelector('.btn-up').onclick = () => {
      // перемещение в начало страницы
      window.scrollTo({
        top: 0,
        left: 0,
        behavior: 'smooth'// плавность анимации
      });
    }
  }
}

btnUp.addEventListener();