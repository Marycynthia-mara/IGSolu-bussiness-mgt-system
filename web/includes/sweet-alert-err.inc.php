    var sub_heading_err = '<h4>' + 'Read the below stated issue(s).' + '</h4>'
    var sweetAlert = <?php echo json_encode($errors); ?>;
     var allAlerts = '<p style="color:#F27474;text-align:center; font-size:200px;"><b>' + '<h2 style="text-align:center;color:#F27474;">' + err_heading + '</h2>'  + '<br>' + sub_heading_err + '</b></p>';
    var i;
    var timer = 0;
        for(i in sweetAlert){
            sweetAlert[i] = '<h4 style="text-align:center;">' + '<span style="color:#F27474;">*</span>' + sweetAlert[i]  + '</h4>';
            allAlerts = allAlerts + "\n" + sweetAlert[i] + "\n";
            timer += + 3;
            }      

    function notifyWithToast(type, message, timer) {
        var duration = timer * 2000;
        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: true,
            timer: duration
        });

        Toast.fire({
            type: type,
            // title: 'Something went wrong',
            html: '<p>' + message + '</p>'
        })
    }
    notifyWithToast('error', allAlerts, timer);
