/*
 * Retrieves a user's information.
 *
 * @param user - the user id of the user who's information you're looking for
 */
function selectuser(user) {
    if(user !== "")
    {
        $.ajax({
            url: 'info',
            method: 'post',
            data: {user: user},
            dataType: 'json',
            success: function (response) {
                if(response.admin)
                {
                    $('#admin').val('yes');
                }
                else
                {
                    $('#admin').val('no');
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