<!DOCTYPE html>
<html>
<?php $this->load->view('member/partial/_head');?>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php $this->load->view('member/partial/_header.php'); ?>

        <div class="content-wrapper">
            <?php $this->load->view('member/partial/_menu');?>

            <div class="content-header mt-4">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-12 text-center">
                            <h1 class="m-0 text-dark">My Courses</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container">
                    <div class="row pb-5" id="courseList">
                        
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('member/partial/_footer.php'); ?>
    </div>

    <?php $this->load->view('member/partial/_modal_password'); ?>

    <?php $this->load->view('member/partial/_script.php'); ?>

    <script>
        $(document).ready(function() {
            loadCourse('latest', '', true);
        });
    </script>
</body>