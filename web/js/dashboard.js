

/*******************************************************************************/
/*                            CHARGEMENT PAGE                                  */
/*******************************************************************************/
if(document.location.hash != null){

   var hash = document.location.hash.replace("#","");

   $(".item-dashboard").each(function(){
      var page_name = $(this).data("pagename");
      if( page_name == hash ){
         var path = $(this).data("path");
         activeItem($(this));
         changeTab(path,page_name);
      }
   });
}






/*******************************************************************************/
/*                              INTERACTIONS                                   */
/*******************************************************************************/

$(".item-dashboard").click( function(){
   activeItem($(this));
   changeTab($(this).data('path'),$(this).data('pagename'));
});


function activeItem(elm){
   $(".item-dashboard").removeClass("active");
   elm.addClass("active");
}

function changeTab(path,page_name)
{
   $('.loading-icon').addClass("active");
   $('#content-dashboard').html("");

   $.ajax({
      url: path,
      method: "POST"
   }).done(function(data) {
      document.location.hash = page_name;
      $('#content-dashboard').html(data);
      $('.loading-icon').removeClass("active");
   });
}

/****************************************************/
/*                  RECHERCHE USER                  */
/****************************************************/
function searchUser(path)
{
   $('.loading-icon-research').addClass("active");
   $('#result-user-research').html("");
   $.ajax({
      url: path,
      method: "POST",
      data: {keyword: $('#userKeyword').val()}
   }).done(function(data) {
      $('#result-user-research').html(data);
      $('.loading-icon-research').removeClass("active");
   });
}
function addUser(path,id)
{
   $('.icon-add-remove-'+id).addClass("active");
   $('.text-add-remove-'+id).addClass("active");
   $.ajax({
      url: path,
      method: "POST"
   }).done(function(data) {
      $('.icon-add-remove-'+id).removeClass("active");
      $('.text-add-remove-'+id).removeClass("active");
      if(data == "ok")
      {
          $('#userSearch'+id).addClass('friendAdded');
          $('#userSearch'+id).html('Ajouté');
          $('#userSearch'+id).attr('onClick','');
      }
      else
      {
         alert('Une erreur est survenue');
      }
   });
}

/****************************************************/
/*                  SAUVEGARDE D'EVENEMENT          */
/****************************************************/

function saveEvent(id)
{
    $('.icon-add-remove-'+id).addClass("active");
    $('.text-add-remove-'+id).addClass("active");
    $.ajax({
        url: path,
        method: "POST"
    }).done(function(data) {
        $('.icon-add-remove-'+id).removeClass("active");
        $('.text-add-remove-'+id).removeClass("active");
        if(data == "ok")
        {
            $('#userSearch'+id).addClass('friendAdded');
            $('#userSearch'+id).html('Ajouté');
            $('#userSearch'+id).attr('onClick','');
        }
        else
        {
            alert('Une erreur est survenue');
        }
    });
}










