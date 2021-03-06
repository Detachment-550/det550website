One of the primary functions for this web application is attendance tracking. There are several subsections of the 
attendance tracking that users will interact with all with different functions. To view this page you must be an admin 
a member of the attendance group.

## View Attendance

This page brings up the current master attendance page to view semesterly and weekly attendance. Cadets are organized by AS Class with their attendance visually displayed in a table format. Additionally LLab and PT totals can be seen on the far right. 

Attendnace Key:

- Green : Present
- Yellow : Excused
- White : No Record/Absent

## Event Attendance 

The event attendance page is where users can view event attendees and submit memos for missed events.

### View Event Attendees

In order to view the users who attended an event you will need to go the the Event Attendance link on the site. Here you
will see a page with a section titled View Event Attendees. This is where any user can view all of the cadets who 
attended a given event.


### Submit an Attendance Memo 

To submit an attendance memo complete the following steps:

1. Navigate to the 'Event Attendance' link.
2. Once at the Event Attendance page fill out the form titled 'Submit Memo' which will have the following fields:
    - Event
    - Memo Reason
    - Submit Memo To
        - Who you wish to view the memo
    - Memo Attachment
        - *Note: This must be in a PDF file format otherwise it will not submit properly*
    - Additional Comments
3. Once you have completed filling out this form click the 'Submit Memo' button and your memo will be visible to whoever 
is responsible for reviewing and approving attendance memos

## Admin Attendance

The admin attendance page is where you can do the following to events:

- Create an event
- Delete an event
- Take attendance for and event
- Review attendance memos
- View historical attendance memos
- Create memo types

### Create an Event

To create an event for the site you must fill out the form titled 'Create an Event'. In this form you will fill out the 
following fields:

- Title
- Date
- Event Type

Once you have filled out this form click the 'Submit' button and your event will be created and posted to the site. 

*Note: You can create all events you know about prior to their occurrence. This will not effect user's attendance 
percentages until the event has passed.*    

### Delete an Event

To delete an event go to the form under 'Modify Event'. Look for the section labeled 'Delete an Event'. To delete an 
event do the following steps:

1. Select the event you would like to delete
    - The events will be listed by event title and date
2. Click the 'Delete' button.
3. Confirm that you are sure you would like to delete the event.

Now the event along with all of it's attendance records will be deleted from the site.

### Take Attendance

To take attendance for an event navigate to the 'Modify Attendance' section in the 'Admin Attendance' page. To set the 
attendance for a given event do the following:

1. Select the event from the dropdown.
    - Events will be listed by label
2. Click the select event button. 
    - This will redirect you to the page where you can either scan or manually set attendance
3. You now have two options. 
    1. If you would like to manually set attendance select the user from section titled 'No RFID 
    Scanner? Select User:'. Here you will select the user and click the 'Submit' button below which will mark that user 
    as present for the event.
    2. If the user has their ID card with them you can have them scan in.
        - *Note: You must have the text field labeled 'Scan RPI ID Card' selected (clicked on) to scan the ID*
        - *Note: Once the user scans their card the form will auto submit. (It may take a few seconds)*

#### View Current Attendance Records

If you would like to see if the user's attendance was successfully recorded click on the 'Show All Attendees' button.
Once clicking this you will be redirected to a page showing all of the cadets marked as present or excused for the 
event your are taking attendance for (the timestamp of when the record was stored will also appear).

#### Add User ID Card

If this is the first time a user is using their card for attendance and they did not register their card when they 
created their account on the website you may have to associate their card with their account. To do this do the 
following:

1. On the event attendance page (the page where you are recording attendance for an event) click the yellow 'Add Cadet 
ID Card' button. On the page you are redirected to it will have a form with the following inputs:
    - Select User
    - Scan Card
2. Select the user account you would like to associate a card with. 
3. Select (click on) the scan card field.
4. Scan the card into the card reader which is plugged into the computer you are using.

Once you scan the card the form will automatically submit and the form will reset. You will now have to navigate back to
the page to set the event attendance. 

*Note: The user who registered their card will have to re scan their card for the event to be marked as present.*

*Note: If the user tries to scan their card to attend an event and their card is not associated with an account you will
be automatically redirected to this 'Connect RFID' page.*

### Edit Attendance Records

Under the 'Modify Attendance' section on the 'Admin Attendance' page you will see a section labeled 'Modify Attendance 
Records'. To manually change an attendance record do the following: 

1. Click on the button in this section labeled 'Modify Attendance'.
2. You will now be redirected to a form titled 'Modify Attendance Records'. Here you will need to select the following:
    - Cadet
        - The user who you would like to modify an attendance record for
    - Event
        - The event you would like to modify the attendance record for
3. Once you select the above values you will be shown the current record for that user on that given event. Change it to
the status you would like the record to reflect (present, absent, excused). 
    - *Note: If you set it to present or excused you can optionally add comments to the record.*
4. Click the 'Update Record' button and the attendance record will be updated in the database.

You have now successfully updated an attendance record.

### Approve/Deny Memos

To approve or deny a memo navigate to the 'Admin Attendance' page and look for the section titled 'Review Attendance 
Memos'. Here you will see a table with all of the pending memo requests. The following information for each request will
be displayed:

- Event
    - The event the memo is for
- User
    - The user who submitted the memo
- Date
    - The date and time the memo was submitted
- Memo For
    - Who the memo was submitted for
- Comments
- Attachment
    - This will be a download link that when clicked will download the PDF that the user submitted with their memo
    
To approve or deny the memo simply click the corresponding button next to each row. 

*Note: Denying a memo still saves the memo in historical memos. It just keeps the user marked as absent from the event.*

### Historical Memos

Here you can search through all memos ever submitted. You can filter this search be the event and the user. To filter 
by either just select the user or event from the dropdown.

#### Download Historical Memo Table

If you would like to store the historical memo table click on the 'Download Table' button in the top right corner of the 
'Historical Attendance Memos' section. This will download the table as a CSV file which you can open in excel.

*Note: Currently the PDFs associated with each excusal will not be exported in the excel file.*

### Create a Memo Type

Here you can create a memo type that can be set for each memo submission. For example some current types are unexcused, 
academics, family etc. 

To create a memo type do the following:

1. Enter the label of the memo type.
    - *Note: The label must be unique (not already exist) otherwise the system will not allow you to add the type.*
2. Enter a description of what the memo type means or constitutes. For example, the 'Academic' type means that you were 
unable to attend an event because of a class or test conflict.
3. Click the 'Add Memo Type' button and the memo type will be added to the database.

### Edit a Memo Type

Here you can change existing memo types. To edit a memo type do the following:

1. Select the memo type you would like to change.
2. Edit either the label or description of the memo type.
3. Click the 'Update Memo Type' button and your changes will be saved.
