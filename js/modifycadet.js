/**
 * Retrieves a user's information.
 *
 * @param user The user id of the user who's information you're looking for
 */
function selectuser(user) {
    if(user !== "")
    {
        $.ajax({
            url: '/index.php/cadet/info/' + user,
            method: 'post',
            dataType: 'json',
            success: function (response) {
                if(response.admin)
                {
                    $('#admin').val('1');
                }
                else
                {
                    $('#admin').val('0');
                }

                $('#rank').val(response.user.rank);
                $('#class').val(response.user.class);
                $('#flight').val(response.user.flight);

                $('#hide').css('display','block');
            },
            error: function (response) {
                console.log(response);
                alert('Error: There was a problem with getting the given cadet information');
                console.log('Error: There was a problem with getting the given cadet information');
            }
        });
    }
    else
    {
        $('#hide').css('display','none');
    }
}