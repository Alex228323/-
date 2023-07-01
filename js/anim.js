$('.basket').on('click', function () {

  var that = $(this).closest('.blok1').find('img');
  var bascket = $(".bas");
  var w = that.width();

  that.clone()
    .css({
      'width': w,
      'position': 'absolute',
      'z-index': '9999',
      top: that.offset().top,
      left: that.offset().left
    })
    .appendTo("body")
    .animate({
      opacity: 0.05,
      left: bascket.offset()['left'],
      top: bascket.offset()['top'],
      width: 20
    }, 1000, function test() {
      $(this).remove();
    });
});      