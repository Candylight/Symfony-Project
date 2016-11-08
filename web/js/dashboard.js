

/*******************************************************************************/
/*                            CHARGEMENT PAGE                                  */
/*******************************************************************************/
if(document.location.hash != null){

   var hash = document.location.hash.replace("#","");

   $(".item-dashboard").each(function(){
      var page_name = $(this).data("pagename");
      if( page_name == hash ){
         var path = $(this).data("path");
         changeTab(path,page_name);
      }
   });
}






/*******************************************************************************/
/*                              INTERACTIONS                                   */
/*******************************************************************************/

$(".item-dashboard").click( function(){
   $(".item-dashboard").removeClass("active");
   $(this).addClass("active");
   changeTab($(this).data('path'),$(this).data('pagename'));
});


function changeTab(path,page_name)
{
   $('.loading-icon').addClass("active");
   $('#content-dashboard').html("");

   $.ajax({
      url: path,
      method: "POST",
      dataType: "html"
   }).done(function(data) {
      document.location.hash = page_name;
      $('#content-dashboard').html(data);
      $('.loading-icon').removeClass("active");
   });
}












