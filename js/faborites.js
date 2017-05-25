

$('#favorite_button').click(function()
{
     var cookie_message, item_id, most_van;//most_van means, that the cookie exists with the procut ID
     item_id = <?php echo $kat_id  ?>; // product ID
     var cookie_val = $.cookie("kedvenc_termek_cookie");
     if (cookie_val)
     {
         most_van = cookie_val.split("|");
     }
     else
     {
         most_van = [];
     }
     if ($.inArray(item_id, most_van) === -1)
     {
         most_van.push(item_id);
         $.removeCookie('kedvenc_termek_cookie');
         $.cookie('kedvenc_termek_cookie', most_van.join("|"), { expires: 7, path: "/" });
         cookie_message = "Product saved as favorite.";
     }
     else
     {
         cookie_message = "This product is alredy on your favorite list.";
     }
     $('#FavoritItemModalResult').html(cookie_message);
     $('#FavoritItemModal').modal('show');
     setTimeout(function()
     {
        $('#FavoritItemModal').modal('hide');
     }, 3000 );
 });
