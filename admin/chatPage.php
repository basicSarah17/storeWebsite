<!-- partial -->
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.0/handlebars.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/list.js/1.1.1/list.min.js'></script>
<script src="./script.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="./style.css">

<?php



?>
<style>
   

    /* Button used to open the chat form - fixed at the bottom of the page */
    .open-button {
        background-color: #555;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        opacity: 0.8;
        position: fixed;
        bottom: 23px;
        right: 28px;
        width: 280px;
        box-sizing: border-box;
    }

    /* The popup chat - hidden by default */
    .chat-popup {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        z-index: 999;
        box-sizing: border-box;
    }
    .chat-popup2 {
        display: none;
        position: fixed;
        bottom: 0;
        right: 15px;
        border: 3px solid #f1f1f1;
        box-sizing: border-box;
    }

    /* Add styles to the form container */
    .form-container {
        max-width: 300px;
        padding: 10px;
        background-color: white;
        box-sizing: border-box;
    }

    /* Full-width textarea */
    .form-container textarea {
        width: 100%;
        padding: 15px;
        margin: 5px 0 22px 0;
        border: none;
        background: #f1f1f1;
        resize: none;
        min-height: 200px;
        box-sizing: border-box;
    }

    /* When the textarea gets focus, do something */
    .form-container textarea:focus {
        background-color: #ddd;
        outline: none;
        box-sizing: border-box;
    }

    /* Set a style for the submit/send button */
    .form-container .btn {
        background-color: #04AA6D;
        color: white;
        padding: 16px 20px;
        border: none;
        cursor: pointer;
        width: 100%;
        margin-bottom: 10px;
        opacity: 0.8;
        box-sizing: border-box;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
        background-color: red;
        box-sizing: border-box;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover,
    .open-button:hover {
        opacity: 1;
        box-sizing: border-box;
    }
</style>










<div class="chat-popup" id="myForm">



<div class="chat ">
    




<script type="text/javascript">
                        var t = setInterval(function () { get_chat_msg() }, 5000);










                        // Function to fetch chat messages
                        function get_chat_msg() {
                            var oxmlHttp = new XMLHttpRequest(); // Initialize oxmlHttp
                            if (oxmlHttp) {
                                oxmlHttp.open("GET", "chat.php?action=get_chat_msg&UserID=<?php echo $UserID; ?>", true);
                                oxmlHttp.onreadystatechange = function () {
                                    if (oxmlHttp.readyState == 4) {
                                        if (oxmlHttp.status == 200) {
                                            get_chat_msg_result(oxmlHttp); // Pass the oxmlHttp object to the result handler
                                        } else {

                                            console.error("Error fetching chat messages. Status code: " + oxmlHttp.status);
                                        }
                                    }
                                };
                                oxmlHttp.send(null);
                            }
                        }

                        function get_chat_msg_result(oxmlHttp) {
                            if (oxmlHttp.readyState == 4 && oxmlHttp.status == 200) {
                                if (document.getElementById("chat") != null) {
                                    document.getElementById("chat").innerHTML = oxmlHttp.responseText;

                                }
                            }
                        }

                        function set_chat_msg() {
                            var oxmlHttpSend;

                            if (typeof XMLHttpRequest != "undefined") {
                                oxmlHttpSend = new XMLHttpRequest();
                            } else if (window.ActiveXObject) {
                                oxmlHttpSend = new ActiveXObject("Microsoft.XMLHttp");
                            }
                            if (oxmlHttpSend == null) {
                                alert("Browser does not support XML Http Request");
                                return;
                            }

                            var strname = "noname";
                            var strmsg = "";
                            var id = "";



                            if (document.getElementById("txtmsg") != null) {
                                strmsg = document.getElementById("txtmsg").value;
                                document.getElementById("txtmsg").value = "";
                           

                            }
 var username = "<?php echo $username; ?>";
var userID = "<?php echo $UserID; ?>";
var msg = encodeURIComponent(strmsg);
var url = "chat.php?action=set_chat_msg&name=" + username + "&msg=" + msg + "&UserID=" + userID;


                                    oxmlHttpSend.open("GET", url, true);

                            // Set a callback function to handle displaying messages after sending
                            oxmlHttpSend.onreadystatechange = function () {
                                if (oxmlHttpSend.readyState == 4 && oxmlHttpSend.status == 200) {
                                    // Call get_chat_msg to fetch and display the updated messages
                                    get_chat_msg();

                                    var element = document.getElementById("chat");
                                    element.scrollIntoView({ behavior: 'smooth', block: 'end' });

                                    element.scrollTop = element.scrollHeight;

                                }
                            };

                            oxmlHttpSend.send(null);
                        }

                        // Initial call to fetch chat messages
                        get_chat_msg();

                    </script>
