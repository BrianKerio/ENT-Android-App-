<?php
session_start();
error_reporting(E_ERROR);
include('include/connections.php');


if(isset($_POST['btnReply'])){
    $hID=$_POST['hID'];
    $remark=$_POST['remark'];

    if(empty($remark)){
        $swal="error";
        $fb="Please write a reply";
    }else{


        $update="UPDATE feedback SET fb='$remark' WHERE fb_id='$hID';";
        if(mysqli_query($con,$update)){
            $swal='success';
            $fb='Sent successfully';
        }else{
            $swal='error';
            $fb='Failed to send please try again';
        }

    }
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?php echo $siteName?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <script src="../../cdn-cgi/apps/head/QJpHOqznaMvNOv9CGoAdo_yvYKU.js"></script>
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/bootstrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/animate.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" />
    <link href="webarch/css/webarch.css" rel="stylesheet" type="text/css" />

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>


<body class="">
<?php
include 'include/navbar.php';
?>

<a href="#" class="scrollup">Scroll</a>
<div class="footer-widget">
<div class="progress transparent progress-small no-radius no-margin">
<div class="progress-bar progress-bar-success animate-progress-bar" data-percentage="79%" style="width: 79%;"></div>
</div>

</div>
<div class="page-content">

<div class="clearfix"></div>
<div class="content">

<div class="page-title">
<h3><span class="semi-bold">New feedback</span></h3>
</div>
<div class="row">
<div class="col-md-12">
<div class="grid simple ">
<div class="grid-title no-border">

</div>
<div class="grid-body no-border">

    <?php
    if(!empty($fb)){
        echo '<div class="alert alert-info text-center">'. $fb.'</div>';
    }

    ?>
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr>
            <th>Action</th>
            <th>#</th>
            <th>Name</th>
            <th>Phone number</th>
            <th>Comment</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $select="SELECT * FROM clients c INNER JOIN feedback f on c.client_id = f.client_id  WHERE  f.fb=''";
        $query=mysqli_query($con,$select);
        while($row=mysqli_fetch_array($query)){
            ?>
            <tr class="odd gradeX">

                <td>
                   
                    <a href="#"data-toggle="modal" data-target="#ModalR<?php echo $row['fb_id']?>"
                       class="btn-link bg-danger">Reply</a>
                </td>

                <td><?php echo $row['fb_id']?> </td>
                <td><?php echo $row['first_name']. ' '. $row['last_name']?> </td>
                <td> <?php echo $row['phone_no']?></td>
                <td><?php echo $row['comment']?> </td>
            </tr>
            <?php

        }
        ?>

        </tbody>
    </table>

    <?php
    $select="SELECT * FROM feedback";
    $query=mysqli_query($con,$select);
    while($row=mysqli_fetch_array($query)) {

        ?>

        <div id="ModalR<?php echo $row['fb_id']?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-sm">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body bg-primary">
                        <form method="post"autocomplete="off">
                            <input type="hidden"value="<?php echo $row['fb_id']?>" name="hID">
                            <label>Write a reply</label>
                            <textarea class="form-control" name="remark" style="height: 150px"placeholder="Reply" required><?php echo $remark?></textarea><br>
                            <input type="submit" class="btn btn-success btn-sm" value="Reply" name="btnReply">
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-link btn-default" data-dismiss="modal">X</button>
                    </div>

                </div>
            </div>

        </div>
        <?php
    }
    ?>

</div>
</div>
</div>
</div>

</div>

</div>


</div>
<script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>

<script src="assets/plugins/jquery/jquery-1.11.3.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-block-ui/jqueryblockui.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>


<script src="webarch/js/webarch.js" type="text/javascript"></script>
<script src="assets/js/chat.js" type="text/javascript"></script>

<script src="assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
<script>
    //TODO AT TO API
    $('table .checkbox input').click(function()
    {
        if ($(this).is(':checked'))
        {
            $(this).parent().parent().parent().toggleClass('row_selected');
        }
        else
        {
            $(this).parent().parent().parent().toggleClass('row_selected');
        }
    });
    // Demo charts - not required 
    $('.customer-sparkline').each(function()
    {
        $(this).sparkline('html',
            {
                type: $(this).attr("data-sparkline-type"),
                barColor: $(this).attr("data-sparkline-color"),
                enableTagOptions: true
            });
    });
</script>
</body>
<script src="dist/js/jquery.dcjqaccordion.2.7.js"></script>
<link type="text/css" rel="stylesheet" href="dist/dataTablesCustom/jquery.dataTables.css?"/>
<script src="dist/dataTablesCustom/jquery.dataTables.min.js"></script>
<script src="dist/dataTablesCustom/dataTables.buttons.min.js"></script>
<script src="dist/dataTablesCustom/buttons.flash.min.js"></script>
<script src="dist/dataTablesCustom/jszip.min.js"></script>
<script src="dist/dataTablesCustom/pdfmake.min.js"></script>
<script src="dist/dataTablesCustom/vfs_fonts.js"></script>
<script src="dist/dataTablesCustom/buttons.html5.min.js"></script>
<script src="dist/dataTablesCustom/buttons.print.min.js"></script>
<script src="dist/dataTablesCustom/buttons.colVis.min.js"></script>
<script>
    $(document).ready(function () {
        var datatable = $('#dataTables-example').dataTable(
            {
                "dom": 'lBfrtip',
                "buttons": [
                    {
                        extend: 'pdf',
                        text:'Print PDF',
                        footer: true,
                        exportOptions: {
                            columns: [1,2,3,4]
                        }
                    },
                ]
            }
        );
    });
</script>
</html>