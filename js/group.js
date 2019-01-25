function select( value ) {
    $.ajax({
        url: 'modify',
        method: 'post',
        data: {group: value},
        dataType: 'json',
        success: function (response) {
            document.getElementById('addcard').innerText = "Add Members to " + response.groupname.label;
            document.getElementById('removecard').innerText = "Remove Members from " + response.groupname.label;

            $("#ngroupmember").empty();
            $("#groupmember").empty();

            var checkbox="<input type='text' style='display:none;' name='group' value='" + response.curgroup + "'>";
            $("#ngroupmember").append($(checkbox));
            checkbox="<input type='text' style='display:none;' name='group' value='" + response.curgroup + "'>";
            $("#groupmember").append($(checkbox));

            response.nonmembers.forEach(function (nonmember) {
                checkbox="<input type='checkbox' id="+nonmember.rin+" value="+nonmember.rin+" name='cadets[]'> <label for="+nonmember.rin+">"+nonmember.firstName + " " + nonmember.lastName + "</label><br>";
                $("#ngroupmember").append($(checkbox));
            });

            response.members.forEach(function (member) {
                checkbox="<input type='checkbox' id="+member.rin+" value="+member.rin+" name='cadets[]'> <label for="+member.rin+">"+member.firstName + " " + member.lastName + "</label><br>";
                $("#groupmember").append($(checkbox));
            });
        }
    });
}

