<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- This file has been downloaded from Bootsnipp.com. Enjoy! -->
    <title>付款成功</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    </style>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>

  <body>
        <script>
            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.com/en_US/messenger.Extensions.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'Messenger'));
        </script>
        <h3>付款完成</h3>
        <button id="close_wid">關閉視窗</button>
  </body>
</html>

<script type="text/javascript">


    window.extAsyncInit = function() {
        MessengerExtensions.getUserID(function success(uids) {
    // User ID was successfully obtained.
        var psid = uids.psid;
    alert(psid);
    }, function error(err, errorMessage) {
    // Error handling code
    });
    };

    $("#close_wid").click(function() {
        MessengerExtensions.requestCloseBrowser(function success() {

        }, function error(err) {

        });
    });



</script>

</body>
</html>
