<?php
    session_start();
    error_reporting(0);
    include('includes/dbconnection.php');
    if (strlen($_SESSION['fosaid']==0)) {
        header('location:logout.php');
    } else{
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> 
</head>
<body>

<div id="wrapper">
    <?php include_once('includes/leftbar.php'); ?>

    <div id="page-wrapper" class="gray-bg">
        <?php include_once('includes/header.php');?>

            <div class="row border-bottom">
            </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                    <div class="col-lg-12">
                    <div class="ibox">

                    <div class="ibox-content">
                        <table class="table table-bordered mg-b-0">
                            <p style="text-align: center; font-size: 30px">Books</p>
                            <thead>
                                <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Published Year</th>
                                <th>ISBN</th>
                                <th>Genre</th>
                                <th>Quantity</th>
                                <th>Action</th>
                                <th>Action</th>
                                </tr>
                            </thead>

                            <?php
                                $ret=mysqli_query($con,"select * from tblbooks");
                                $cnt=1;
                                while ($row=mysqli_fetch_array($ret)) {
                            ?>

                            <tbody>
                                <tr>
                                    <td><?php echo $cnt;?></td>
                                    <td><?php echo $row['Title'];?></td>
                                    <td><?php echo $row['Author'];?></td>
                                    <td><?php echo $row['PublishedYear'];?></td>
                                    <td><?php echo $row['ISBN'];?></td>
                                    <td><?php echo $row['Genre'];?></td>
                                    <td><?php echo $row['Quantity'];?></td>
                                    <td><a href="updatebook.php?editid=<?php echo $row['ID'];?>">Edit</a>
                                    <td><a href="deletebook.php?delid=<?php echo $row['ID'];?>">Delete</a>
                                </tr>
                                <?php 
                                    $cnt=$cnt+1;
                                }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <?php include_once('includes/footer.php');?>

    </div>
</div>



<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- Steps -->
<script src="js/plugins/steps/jquery.steps.min.js"></script>

<!-- Jquery Validate -->
<script src="js/plugins/validate/jquery.validate.min.js"></script>


<script>
    $(document).ready(function(){
        $("#wizard").steps();
        $("#form").steps({
            bodyTag: "fieldset",
            onStepChanging: function (event, currentIndex, newIndex)
            {
                // Always allow going backward even if the current step contains invalid fields!
                if (currentIndex > newIndex)
                {
                    return true;
                }

                // Forbid suppressing "Warning" step if the user is to young
                if (newIndex === 3 && Number($("#age").val()) < 18)
                {
                    return false;
                }

                var form = $(this);

                // Clean up if user went backward before
                if (currentIndex < newIndex)
                {
                    // To remove error styles
                    $(".body:eq(" + newIndex + ") label.error", form).remove();
                    $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                }

                // Disable validation on fields that are disabled or hidden.
                form.validate().settings.ignore = ":disabled,:hidden";

                // Start validation; Prevent going forward if false
                return form.valid();
            },
                onStepChanged: function (event, currentIndex, priorIndex)
            {
                // Suppress (skip) "Warning" step if the user is old enough.
                if (currentIndex === 2 && Number($("#age").val()) >= 18)
                {
                    $(this).steps("next");
                }

                // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                if (currentIndex === 2 && priorIndex === 3)
                {
                    $(this).steps("previous");
                }
            },
                onFinishing: function (event, currentIndex)
            {
                var form = $(this);

                // Disable validation on fields that are disabled.
                // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                form.validate().settings.ignore = ":disabled";

                // Start validation; Prevent form submission if false
                return form.valid();
            },
                onFinished: function (event, currentIndex)
            {
                var form = $(this);

                // Submit form input
                form.submit();
            }
            }).validate({
                errorPlacement: function (error, element)
                {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    }
                }
        });
   });
</script>

<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/headroom.js"></script>
<script src="js/masterchief.min.js"></script>

</body>
</html>