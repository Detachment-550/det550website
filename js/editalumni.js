/*
 * Retrieves all of a given alumnus' information.
 *
 * @param alum - the alumni_id of a given alumni account
 */
function selectalum(alum) {
    if(alum !== "")
    {
        $.ajax({
            url: '/index.php/alumni/info',
            method: 'post',
            data: {alumni: alum},
            dataType: 'json',
            success: function (response) {
                $('#efirst').val(response.alumni.first_name);
                $('#elast').val(response.alumni.last_name);
                $('#erank').val(response.alumni.rank);
                $('#eemail').val(response.alumni.email);
                $('#ephone').val(response.alumni.phone);
                $('#emajor').val(response.alumni.major);
                $('#eposition').val(response.alumni.position);

                $('#hide').css('display', 'block');
            },
            error: function (response) {
                console.log(response);
                console.log("Error: There was a problem retrieving information about the alumni with the alumni_id " + alum);
                alert("Error: There was a problem retrieving information about the alumni with the alumni_id " + alum);
            }
        });
    }
    else
    {
        $('#hide').css('display', 'none');
    }

}