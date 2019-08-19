var approve_button = function(cell, formatterParams){ //plain text value
    return "<button class='btn-sm btn-success' type='button' onclick='approve_memo(" + cell.getRow().getData().memo_id +
        ")'>Approve</button>";
};

var deny_button = function(cell, formatterParams){ //plain text value
    return "<button class='btn-sm btn-danger' type='button' onclick='deny_memo(" + cell.getRow().getData().memo_id +
        ")'>Deny</button>";
};

var memo_table = new Tabulator("#memo_table", {
    placeholder:"There are no new memos at this time",
    layout:"fitColumns",
    ajaxURL:"/index.php/attendance/get_new_memos",
    ajaxContentType:"json",
    height: "400px",
    index:'excuse_id',
    ajaxResponse:function(url, params, response){
        //url - the URL of the request
        //params - the parameters passed with the request
        //response - the JSON object returned in the body of the response.
        for(var x = 0; x < response.length; x++)
        {
            response[x].full_name = response[x].first_name + ' ' + response[x].last_name;
            if(response[x].attachment !== null)
            {
                response[x].attachment = '<a href="/index.php/attendance/download_memo_attachment/' + response[x].memo_id + '">Download Attachment</a>';
            }
        }
        return response; //return the tableData property of a response json object
    },
    columns:[ //Define Table Columns
        {title:"Memo ID", field:"memo_id", visible: false},
        {title:"Event ID", field:"event", visible: false},
        {title:"Event", field:"name"},
        {title:"User", field:"full_name"},
        {title:"Date", field:"date_created", align:"center", formatter:"datetime", formatterParams:{
                inputFormat:"YYYY-MM-DD hh:mm:ss",
                outputFormat:"M/D/YY h:mm A",
                invalidPlaceholder:"No Date",
            }},
        {title:"Approved", field:"approved", visible: false},
        {title:"Comments", field:"comments", formatter:"textarea"},
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
    ajaxResponse:function(url, params, response){
        //url - the URL of the request
        //params - the parameters passed with the request
        //response - the JSON object returned in the body of the response.
        for(var x = 0; x < response.length; x++)
        {
            response[x].full_name = response[x].first_name + ' ' + response[x].last_name;
            if(response[x].attachment !== null)
            {
                response[x].attachment = '<a href="/index.php/attendance/download_memo_attachment/' + response[x].memo_id + '">Download Attachment</a>';
            }
        }
        return response; //return the tableData property of a response json object
    },
    columns:[ //Define Table Columns
        {title:"Memo ID", field:"memo_id", visible: false},
        {title:"Event ID", field:"event", visible: false},
        {title:"Event", field:"name"},
        {title:"User ID", field:"id",visible:false},
        {title:"User", field:"full_name"},
        {title:"Date", field:"date_created", align:"center", formatter:"datetime", formatterParams:{
                inputFormat:"YYYY-MM-DD hh:mm:ss",
                outputFormat:"M/D/YY h:mm A",
                invalidPlaceholder:"No Date",
            }},
        {title:"Approved", field:"approved", visible: false},
        {title:"Comments", field:"comments", formatter:"textarea"},
        {title:"Attachments", field:"attachment", formatter:"html"},

    ]
});

/*
 * Approves a memo.
 */
function approve_memo(memo_id) {
    $.ajax({
        url: '/index.php/attendance/approve_memo/' + memo_id,
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

/*
 * Denies a memo.
 */
function deny_memo(memo_id) {
    $.ajax({
        url: '/index.php/attendance/deny_memo/' + memo_id,
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

/*
 * Sets a filter on the historical memo page based on user.
 *
 * @param user - the user id
 */
function filter_user(user) {
    if(user === "")
    {
        historical_memo_table.clearFilter(true);
    }
    else
    {
        historical_memo_table.setFilter('id', '=', user);
    }
}

/*
 * Sets a filter on the historical memo page based on user.
 *
 * @param user - the user id
 */
function filter_event(event) {
    if(event === "")
    {
        historical_memo_table.clearFilter(true);
    }
    else
    {
        historical_memo_table.setFilter('event', '=', event);
    }
}

/*
 * Downloads the table in an csv format.
 */
function download_historical_table() {
    historical_memo_table.download('csv', 'historical_memos.csv');
}

/*
 * Gets the memo type's information.
 *
 * @param memo_type - the memo type id
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