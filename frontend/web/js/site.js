var intDiff = $('#time_show').data('time')*60;//倒计时总秒数量
function timer(intDiff){
    window.setInterval(function(){
    $('#time_show').html('<s></s>'+ Math.floor(intDiff / 60));
    intDiff--;
    }, 1000);
}
$(function(){
  if (intDiff != 0) {
      timer(intDiff);
  }
}); 