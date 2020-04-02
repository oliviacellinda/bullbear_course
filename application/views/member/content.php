<!DOCTYPE html>
<html>
<?php $this->load->view('member/partial/_head');?>

<style>
    .duration::before {
        content: " (";
        white-space: pre;
    }
    .duration::after {
        content: ')';
    }
</style>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <?php $this->load->view('member/partial/_header.php'); ?>

        <div class="content-wrapper">

            <div class="content bg-white border-bottom">
                <div class="container">
                    <div class="row py-4">
                        <div class="col-12 col-sm-5 col-md-4">
                            <img src="<?=base_url('course/thumbnail/' . $video['thumbnail_paket']);?>" alt="" class="img-fluid">
                        </div>
                        <div class="col-12 col-sm-7 col-md-8 mt-3 mt-sm-0">
                            <h4><?=$video['nama_paket'];?></h4>
                            <div style="white-space: pre-line;"><?=$video['deskripsi_paket'];?></div>
                            <?php if(!$is_owner) : ?>
                                <h5 class="mt-4"><?='Rp '.number_format($video['harga_paket'], 2, ',', '.');?></h5>
                                <div class="mt-3">
                                    <?php if($is_pending) : ?>
                                        <p><em>Pending payment. Please wait while we are processing your payment.</em></p>
                                    <?php else : ?>
                                        <button id="btnGateway" class="btn btn-primary">Buy and pay with Midtrans</button>
                                        <a href="http://<?=$video['link_video'];?>" target="_blank" rel="noopener noreferrer">
                                            <button id="btnOutside" class="btn btn-primary mt-1 mt-md-0">Buy from Tokopedia</button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-header mt-4">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-12 text-center">
                            <h1 class="m-0 text-dark">Course Content</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container">
                    <div class="row pb-5">
                        
                        <?php if($content != '') : ?>

                            <?php if($is_owner) : ?>
                                <div class="col-md-4 d-none d-md-block">
                                    <div class="list-group">
                                        <?php for($i=0; $i<count($content); $i++) : ?>
                                            <button type="button" class="list-group-item list-group-item-action" data-id="<?=$content[$i]['id_video'];?>" data-file="<?=$content[$i]['file_video'];?>">
                                                <?=$content[$i]['nama_video'];?>
                                                <span class="duration"><?=$content[$i]['durasi_video'];?></span>
                                            </button>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <video id="player" class="video-js vjs-fluid vjs-theme-fantasy" oncontextmenu="return false;" controls preload="none" data-setup="{}">
                                        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video</p>
                                    </video>
                                </div>
                                <div class="col-12 d-block d-md-none mt-3">
                                    <div class="list-group">
                                        <?php for($i=0; $i<count($content); $i++) : ?>
                                            <button type="button" class="list-group-item list-group-item-action" data-id="<?=$content[$i]['id_video'];?>" data-file="<?=$content[$i]['file_video'];?>">
                                                <?=$content[$i]['nama_video'];?>
                                                <span class="duration"><?=$content[$i]['durasi_video'];?></span>
                                            </button>
                                        <?php endfor; ?>
                                    </div>
                                </div>

                            <?php else : ?>
                                <div class="col-12 col-sm-10 col-md-8 mx-auto">
                                    <div class="list-group">
                                        <?php for($i=0; $i<count($content); $i++) : ?>
                                            <button type="button" class="list-group-item list-group-item-action">
                                                <?=$content[$i]['nama_video'];?>
                                                <span class="duration"><?=$content[$i]['durasi_video'];?></span>
                                            </button>
                                        <?php endfor; ?>
                                    </div>
                                </div>

                            <?php endif; ?>

                        <?php else : ?>

                            <div class="col-12 text-center">
                                <p>No data.</p>
                            </div>

                        <?php endif; ?>

                    </div>
                </div>
            </div>

        </div>

        <?php $this->load->view('member/partial/_footer.php'); ?>
    </div>

    <?php $this->load->view('member/partial/_modal_password'); ?>

    <?php $this->load->view('member/partial/_script.php'); ?>

    <?php if($is_owner) : ?>
        <script>
            var uri = window.location.href.split('/');
            var player = videojs('player');

            function loadVideo(data) {
                $('.list-group-item').removeClass('active');
                $('.list-group').each(function() {
                    $(this).find('.list-group-item').eq(data.index).addClass('active');
                });
                player.src([
                    {type: 'video/mp4', src: base_url.index + 'course/content/' + uri[uri.length-1] + '/' + data.file}
                ]);
            }

            function markFirst() {
                let first = new Object();
                first.id = $('.list-group-item:first').data('id');
                first.file = $('.list-group-item:first').data('file');
                first.index = 0;
                loadVideo(first);
            }

            $(document).ready(function() {
                markFirst();

                $('.list-group').on('click', '.list-group-item', function() {
                    let data = new Object();
                    data.id = $(this).data('id');
                    data.file = $(this).data('file');
                    data.index = $(this).index();
                    loadVideo(data);
                });
            });
        </script>

    <?php else : ?>
        <script>
            $('#btnGateway').click(function() {
                let uri = window.location.href.split('/');
                $.ajax({
                    type    : 'post',
                    url     : '<?=base_url('member/transaction/placeOrder');?>',
                    data    : { id : uri[uri.length-1] },
                    dataType: 'json',
                    beforeSend: function() {
                        $('.body-overlay').show();
                    },
                    success : function(response) {
                        if(response.type == 'success') {
                            window.location = response.redirect_url;
                        }
                        else {
                            showAlert(response);
                        }
                    },
                    error   : function(response) {
                        console.log(response.responseText);
                        toastr.error('Internal server error.', 'Error!');
                    },
                    complete : function() {
                        $('.body-overlay').hide();
                    }
                });
            });
        </script>

    <?php endif; ?>

</body>