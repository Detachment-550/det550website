function validateNewUser()
{
    var fail = 0;
    var first = document.forms["createcadet"]["firstname"].value;
    var last = document.forms["createcadet"]["lastname"].value;
    var pass = document.forms["createcadet"]["pass"].value;
    var cpass = document.forms["createcadet"]["pass2"].value;
    var rin = document.forms["createcadet"]["rin"].value;

    if (first == "") {
        document.getElementById("firstname").style.borderColor = "#ff4a4a";
        fail = 1;
    }
    if (last == "") {
        document.getElementById("lastname").style.borderColor = "#ff4a4a";
        fail = 1;
    }
    if (rin == "") {
        document.getElementById("rin").style.borderColor = "#ff4a4a";
        fail = 1;
    }
    if (pass == "") {
        document.getElementById("password").style.borderColor = "#ff4a4a";
        fail = 1;
    }
    if (cpass == "") {
        document.getElementById("confpassword").style.borderColor = "#ff4a4a";
        fail = 1;
    }
    if( fail == 1 ) {
        alert("Highlighted fields must be filled out to save changes");
        return false;
    }
}