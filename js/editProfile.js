$('#phone').mask('(000) 000-0000');

tinymce.init({
    selector: '#cadetbio, #afgoals, #pgoals, #awards',
    toolbar: 'table tabledelete fontselect fontsizeselect link wordcount forecolor backcolor numlist bullist',
    menubar: 'file table edit insert view format table tools help',
    plugins: 'link table lists help wordcount',
    font_formats: 'Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n;Times New Roman=times new roman,times',
    fontsize_formats: '8pt 10pt 11pt 12pt 14pt 18pt 24pt 36pt'
  });

//TODO: Figre out what this does
function validateForm()
{
    var fail = 0;
    var primEmail = document.forms["genInfo"]["pemail"].value;
    var primPhone = document.forms["genInfo"]["pphone"].value;
    if (primEmail == "") {
        document.getElementById("pemail").style.borderColor = "#ff4a4a";
        fail = 1;
    }
    if (primPhone == "") {
        document.getElementById("pphone").style.borderColor = "#ff4a4a";
        fail = 1;
    }
    if( fail == 1 ) {
        alert("Highlighted fields must be filled out to save changes");
        return false;
    }
}

/*
 * Validates the form input and stores the masked phone number.
 */
function validate()
{
    $('#pphone').val($('#phone').cleanVal()); // Cleans the masked input

    return true;
}
