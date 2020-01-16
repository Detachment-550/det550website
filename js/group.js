//TODO: Add logic to prevent all users from being removed from the admin group
/**
 * Retrieves all of the members of a given group.
 *
 * @param value The group's id
 */
function select( value ) {
    $.ajax({
        url: 'members',
        method: 'post',
        data: {group: value},
        dataType: 'json',
        success: function (response) {
            if(value === "")
            {
                $("#add").css('display', 'none');
                $("#remove").css('display', 'none');
            }
            else
            {
                $("#ngroupmember").empty();
                $("#groupmember").empty();

                $("#ngroupmember").append("<input type='text' style='display:none;' name='group' value='" + value + "'>");
                $("#groupmember").append("<input type='text' style='display:none;' name='group' value='" + value + "'>");

                // Loops through all users on the site
                response.users.forEach(function (user) {
                    var found = false;

                    // Looks at each group member
                    for(var x = 0; x < response.members.length; x++)
                    {
                        if(user.id === response.members[x].id)
                        {
                            $("#groupmember").append("<input type='checkbox' class='checkbox' id='" + user.id + "' value='" + user.id + "' " +
                                "name='users[]'> <label for=" + user.id + ">" + user.rank + " " + user.last_name + "</label><br>");
                            found = true;
                        }
                    }
                    if(!found)
                    {
                        $("#ngroupmember").append("<input type='checkbox' class='checkbox' id='" + user.id + "' value='" + user.id + "' " +
                            "name='users[]'> <label for=" + user.id + ">" + user.rank + " " + user.last_name + "</label><br>");
                    }
                });

                $("#add").css('display', 'block');
                $("#remove").css('display', 'block');
            }
        },
        error: function (response) {
            console.log(response);
            alert('Error: Something went wrong');
        }
    });
}

