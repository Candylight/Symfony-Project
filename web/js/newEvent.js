/**
 * Created by sylva on 05/02/2017.
 */

$(document).ready(function(){
    var autocomplete = new google.maps.places.Autocomplete(
        (
            document.getElementById('address')), {
            types: ['address']
        });
});
