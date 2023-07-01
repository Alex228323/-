$('form').on('submit', function (e) {
  e.preventDefault();//отменяет действие по умолчанию
  $.ajax({
    url: $(this).attr('action'),//передаёт action со страницы
    type: "POST",//метод отправки данных
    cache: false,
    data: $(this).serialize(),
  });
})