

$(".item-dashboard").click( function(){
   $(".item-dashboard").removeClass("active");
   $(this).addClass("active");
   changeTab($(this).data('path'));
});

function changeTab(path)
{
   $.ajax({
      url: path,
      method: "POST",
      dataType: "html"
   }).done(function(data) {
      $('#content-dashboard').html(data);
   });
}

