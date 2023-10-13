/*====  SETTING MESSAGE INTERVAL  =====*/

setInterval(function() {
    msg("");
}, 13000);

/*====  MESSAGE FUNCTION  =====*/

function msg(obj){
    document.getElementById('msg').innerHTML = obj;
}

/*====  COMPOSE CONTENT  =====*/

function compose(){

 var obj;

    if (window.ActiveXObject) {
        obj = new ActiveXObject('Microsoft.XMLHTTP');
    } else {
        obj = new XMLHttpRequest();
    }   
    obj.onreadystatechange = function(){
        if (obj.status == 200 && obj.readyState == 4) {
            console.log(obj.responseText);
            document.getElementById('content_area').innerHTML = obj.responseText;
        }
    }
    obj.open("POST",'process.php');
    obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
    obj.send('action=compose');
}

/*====  INBOX  CONTENT  =====*/

function inbox(){
    var obj;
   
       if (window.ActiveXObject) {
           obj = new ActiveXObject('Microsoft.XMLHTTP');
       } else {
           obj = new XMLHttpRequest();
       }   
       obj.onreadystatechange = function(){
           if (obj.status == 200 && obj.readyState == 4) {
               console.log(obj.responseText);
               document.getElementById('content_area').innerHTML = obj.responseText;
           }
       }
       obj.open("POST",'process.php');
       obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
       obj.send('action=inbox');
   }

/*====  SENT CONTENT  =====*/

   function sent(){

    var obj;
   
       if (window.ActiveXObject) {
           obj = new ActiveXObject('Microsoft.XMLHTTP');
       } else {
           obj = new XMLHttpRequest();
       }   
       obj.onreadystatechange = function(){
           if (obj.status == 200 && obj.readyState == 4) {
               console.log(obj.responseText);
               document.getElementById('content_area').innerHTML = obj.responseText;
           }
       }
       obj.open("POST",'process.php');
       obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
       obj.send('action=sent');
   }

/*====  DRAFT CONTENT  =====*/

   function draft(){

    var obj;
   
       if (window.ActiveXObject) {
           obj = new ActiveXObject('Microsoft.XMLHTTP');
       } else {
           obj = new XMLHttpRequest();
       }   
       obj.onreadystatechange = function(){
           if (obj.status == 200 && obj.readyState == 4) {
               console.log(obj.responseText);
               document.getElementById('content_area').innerHTML = obj.responseText;
           }
       }
       obj.open("POST",'process.php');
       obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
       obj.send('action=draft');
   }

/*====  TRASH CONTENT  =====*/

   function trash(){

    var obj;
   
       if (window.ActiveXObject) {
           obj = new ActiveXObject('Microsoft.XMLHTTP');
       } else {
           obj = new XMLHttpRequest();
       }   
       obj.onreadystatechange = function(){
           if (obj.status == 200 && obj.readyState == 4) {
               console.log(obj.responseText);
               document.getElementById('content_area').innerHTML = obj.responseText;
           }
       }
       obj.open("POST",'process.php');
       obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
       obj.send('action=trash');
   }

/*====  SENDING EMAIL  =====*/

function send_email(){
    var to      = document.getElementById('to').value;
    var cc      = document.getElementById('cc').value;
    var subject = document.getElementById('subject').value;
    var message = document.getElementById('message').value;

    var cc_array = cc.split(","); // making an array for cc -emails
    var ccjson   = JSON.stringify(cc_array); // converting it into json string - stringify function

    // console.log(ccjson);
    if (to == "" || subject == "" || message == "") {
        return msg("<p style='text-align:center;color:red;'>All Fields are required</p>");
    }
    msg("");

    var obj;
    if (window.ActiveXObject) {
        obj = new ActiveXObject('Microsoft.XMLHTTP');
    } else {
        obj = new XMLHttpRequest();
    }

    obj.onreadystatechange = function(){
        if (obj.status == 200 && obj.readyState == 4) {
            // console.log(obj.responseText);
            msg(obj.responseText);
            reset();
        }
    }
    obj.open("POST",'process.php');
    obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
    obj.send("action=send_email&to="+to+"&subject="+subject+"&ccjson="+encodeURIComponent(ccjson)+"&message="+message);
}

/*====  RESETTING FIELDS FUNCTION  =====*/

function reset(){ 

    var to       =  document.getElementById('to').value = "";
    var cc       =  document.getElementById('cc').value = "";
    var subject  =  document.getElementById('subject').value = "";
    var message  =  document.getElementById('message').value = "";
}
/*====  SENDING EMAIL TO DRAFT  =====*/

function send_draft(){

    var to       =  document.getElementById('to').value;
    var cc       =  document.getElementById('cc').value;
    var subject  =  document.getElementById('subject').value;
    var message  =  document.getElementById('message').value;

    if (to == "" || subject == "" || message == "") {
        return msg("<p style='text-align:center;color:red;'>Fill Something</p>");
    }
    msg("");

    var obj;
    if (window.XMLHttpRequest) {
        obj = new XMLHttpRequest();
    } else {
        obj = new ActiveXObject('Microsoft.XMLHTTP');
    }
    obj.onreadystatechange = function(){
        if (obj.status == 200 && obj.readyState == 4) {
            // console.log(obj.responseText);
            msg(obj.responseText);
            reset();
        }
    }
    obj.open("POST","process.php");
    obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
    obj.send("action=send_draft&to="+to+"&subject="+subject+"&cc="+cc+"&message="+message);
}

/*====  SENDING INBOX EMAIL'S TO TRASH  =====*/

function send_trash_inbox(){
    var checkbox = document.querySelector('input[type="checkbox"]:checked').value;
    console.log(checkbox);

    var obj;
    if (window.XMLHttpRequest) {
        obj = new XMLHttpRequest();
    } else {
        obj = new ActiveXObject('Microsoft.XMLHTTP');
    }
    obj.onreadystatechange = function(){
        if (obj.status == 200 && obj.readyState == 4) {
            // console.log(obj.responseText);
            msg(obj.responseText);
            setTimeout(function() {
            inbox();
            }, 1000);
        }
    }
    obj.open("POST","process.php");
    obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
    obj.send("action=send_trash_inbox&email_id="+checkbox);
}

/*====  SENDING SENT EMAIL'S TO TRASH  =====*/

function send_trash_sent(){
    var checkbox = document.querySelector('input[type="checkbox"]:checked').value;
    console.log(checkbox);

    var obj;
    if (window.XMLHttpRequest) {
        obj = new XMLHttpRequest();
    } else {
        obj = new ActiveXObject('Microsoft.XMLHTTP');
    }
    obj.onreadystatechange = function(){
        if (obj.status == 200 && obj.readyState == 4) {
            // console.log(obj.responseText);
            msg(obj.responseText);
            setTimeout(function() {
            sent();
            }, 1000);
        }
    }
    obj.open("POST","process.php");
    obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
    obj.send("action=send_trash_sent&email_id="+checkbox);
}

/*====  SENDING DRAFT EMAIL'S TO TRASH  =====*/

function send_trash_draft(){
    var checkbox = document.querySelector('input[type="checkbox"]:checked').value;
    console.log(checkbox);

    var obj;
    if (window.XMLHttpRequest) {
        obj = new XMLHttpRequest();
    } else {
        obj = new ActiveXObject('Microsoft.XMLHTTP');
    }
    obj.onreadystatechange = function(){
        if (obj.status == 200 && obj.readyState == 4) {
            // console.log(obj.responseText);
            msg(obj.responseText);
            setTimeout(function() {
                draft();
            }, 1000);
        }
    }
    obj.open("POST","process.php");
    obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
    obj.send("action=send_trash_draft&email_id="+checkbox);
}

/*====  REMOVING EMAIL'S FROM TRASH  =====*/

function trash_remove(){
    var checkbox = document.querySelector('input[type="checkbox"]:checked').value;
    // console.log(checkbox);

    var obj;
    if (window.ActiveXObject) {
        obj = new ActiveXObject('Microsoft.XMLHTTP');
    } else {
        obj = new XMLHttpRequest();
    }
    obj.onreadystatechange = function(){
        if (obj.status = 200 && obj.readyState == 4) {
            // console.log(obj.responseText);
            msg(obj.responseText);
            setTimeout(function() {
                trash();
            }, 1000);
        }
    }
    obj.open("POST","process.php");
    obj.setRequestHeader('content-type','application/x-www-form-urlencoded');
    obj.send("action=trash_remove&email_id="+checkbox);
}