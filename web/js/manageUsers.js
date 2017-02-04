/**
 * Created by sylva on 04/02/2017.
 */

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
function addFriend(path,id)
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
