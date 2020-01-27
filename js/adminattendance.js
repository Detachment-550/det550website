var approve_button = function(cell, formatterParams){ //plain text value
    if(cell.getRow().getData().event_id !== '')
    {
        return "<button class='btn-sm btn-success' type='button' onclick='approve_memo(" + cell.getRow().getData().id +
            ")'>Approve</button>";
    }
    else
    {
        return '';
    }
};

var deny_button = function(cell, formatterParams){ //plain text value
    if(cell.getRow().getData().event_id !== '')
    {
        return "<button class='btn-sm btn-danger' type='button' onclick='deny_memo(" + cell.getRow().getData().id +
            ")'>Deny</button>";
    }
    else
    {
        return '';
    }
};

var memo_table = new Tabulator("#memo_table", {
    placeholder:"There are no new memos at this time",
    layout:"fitColumns",
    ajaxURL:"/index.php/attendance/get_new_memos",
    ajaxContentType:"json",
    height: "400px",
    index:'id',
    ajaxResponse: memo_format,
    initialSort:[
        {column:"created_at", dir:"desc"}, //sort by this first
    ],
    columns:[
        {title:"Memo ID", field:"id", visible: false},
        {title:"Event ID", field:"event_id", visible: false},
        {title:"Event", field:"event.name"},
        {title:"User", field:"full_name"},
        {title:"Date", field:"created_at", align:"center", formatter:"datetime", formatterParams:{
                inputFormat:"YYYY-MM-DD hh:mm:ss",
                outputFormat:"M/D/YY h:mm A",
                invalidPlaceholder:"No Date",
            }},
        {title:"Approved", field:"approved", visible: false},
        {title:"Memo For", field:"memo_for_name"},
        {title:"Comments", field:"comments", formatter:'textarea'},
        {title:"Attachment", field:"attachment",formatter:'html'},
        {title:"Approve", formatter:approve_button, width:100, align:"center", headerSort:false },
        {title:"Deny", formatter:deny_button, width:100, align:"center", headerSort:false },

    ]
});

var historical_memo_table = new Tabulator("#historical_memo_table", {
    placeholder:"There are no new memos at this time",
    layout:"fitColumns",
    ajaxURL:"/index.php/attendance/get_all_memos",
    ajaxContentType:"json",
    height: "400px",
    index:'excuse_id',
    ajaxResponse: memo_format,
    initialSort:[
        {column:"created_at", dir:"desc"}, //sort by this first
    ],
    columns:[
        {title:"Memo ID", field:"attendance_memo_id", visible: false},
        {title:"Event ID", field:"event_id", visible: false},
        {title:"Event", field:"event.name"},
        {title:"User ID", field:"user_id",visible:false},
        {title:"User", field:"full_name"},
        {title:"Date", field:"created_at", align:"center", formatter:"datetime", formatterParams:{
                inputFormat:"YYYY-MM-DD hh:mm:ss",
                outputFormat:"M/D/YY h:mm A",
                invalidPlaceholder:"No Date",
            }},
        {title:"Approved", field:"approved", visible: false},
        {title:"Memo For", field:"memo_for_name"},
        {title:"Comments", field:"comments", formatter:'textarea'},
        {title:"Attachments", field:"attachment", formatter:"html"},

    ]
});

/**
 * Formats the json response of memos for tabulator
 */
function memo_format(url, params, response){
    for(var x = 0; x < response.length; x++)
    {
        response[x].full_name = response[x].created_by.first_name + ' ' + response[x].created_by.last_name;
        response[x].memo_for_name = response[x].memo_for.first_name + ' ' + response[x].memo_for.last_name;
        if(response[x].attachment !== null)
        {
            response[x].attachment = '<a href="/index.php/attendance/download_memo_attachment/' +
                response[x].id + '">Download Attachment</a>';
        }
    }
    return response;
}

/**
 * Approves a memo.
 *
 * @param attendance_memo_id
 */
function approve_memo(attendance_memo_id) {
    $.ajax({
        url: '/index.php/attendance/approve_memo/' + attendance_memo_id,
        method: 'post',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            memo_table.setData();
        },
        error: function (response)
        {
            console.log(response);
            console.log("Error: Something went wrong with approving the memo");
            alert("Error: Something went wrong with approving the memo");
        }
    });
}

/**
 * Denies a memo.
 *
 * @param attendance_memo_id
 */
function deny_memo(attendance_memo_id) {
    $.ajax({
        url: '/index.php/attendance/deny_memo/' + attendance_memo_id,
        method: 'post',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            memo_table.setData();
        },
        error: function (response)
        {
            console.log(response);
            console.log("Error: Something went wrong with denying the memo");
            alert("Error: Something went wrong with denying the memo");
        }
    });
}

/**
 * Sets a filter on the historical memo page based on user.
 */
function set_filters() {
    historical_memo_table.clearFilter(true);

    if($('#historical_event').val() !== '')
    {
        historical_memo_table.addFilter('event_id', '=', $('#historical_event').val());
    }

    if($('#historical_user').val() !== '')
    {
        historical_memo_table.addFilter('user_id', '=', $('#historical_user').val());
    }
}

/**
 * Downloads the table in an csv format.
 */
function download_historical_table() {
    historical_memo_table.download('csv', 'historical_memos.csv');
}

/**
 * Gets the memo type's information.
 *
 * @param memo_type The memo type id
 */
function get_memo_type(memo_type) {
    if(memo_type !== "")
    {
        $.ajax({
            url: '/index.php/attendance/get_memo_type/' + memo_type,
            method: 'post',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('#edit_label').val(response.label);
                $('#edit_description').val(response.description);
                $('#hide_edit').css('display','block');
            },
            error: function (response)
            {
                console.log(response);
                console.log("Error: Something went wrong with getting the memo type");
                alert("Error: Something went wrong with getting the memo type");
            }
        });
    }
    else
    {
        $('#hide_edit').css('display','none');
    }
}
