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
                                        <button id="btnGateway" class="btn btn-success">Buy and pay with Midtrans</button>
                                        <a href="<?=$video['link_video'];?>" target="_blank" rel="noopener noreferrer">
                                            <button id="btnOutside" class="btn btn-success mt-1 mt-md-0">Buy from Tokopedia</button>
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
                                <div class="col-md-4 d-none d-md-block px-0">
                                    <div class="list-group"></div>
                                </div>
                                <div class="col-md-8 pl-md-4">
                                    <video id="player" class="video-js vjs-fluid vjs-theme-fantasy" oncontextmenu="return false;" controls preload="none" data-setup="{}">
                                        <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video</p>
                                    </video>
                                </div>
                                <div class="col-12 d-block d-md-none mt-3">
                                    <div class="list-group"></div>
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
            var progress;

            function loadVideo(data) {
                $(document).find('.list-group-item').removeClass('active');
                $('.list-group').each(function() {
                    $(this).find('.list-group-item').eq(data.index).addClass('active');
                });
                player.src([
                    {type: 'video/mp4', src: base_url.index + 'course/content/' + uri[uri.length-1] + '/' + data.file}
                ]);
                $('video').data('id', data.id);
                $('video').data('order', data.order);
            }

            function loadList() {
                return $.ajax({
                    type    : 'post',
                    url     : '<?=base_url('member/video/getContentList');?>',
                    dataType: 'json',
                    data    : { id: uri[uri.length-1] },
                    beforeSend: function() {
                        loading('.list-group');
                    },
                    success : function(data) {
                        if(!jQuery.isPlainObject(data)) {
                            window.location = '<?=base_url('member');?>';
                        }
                        else if(data.type == 'success') {
                            $('.list-group').empty();

                            data = JSON.parse(data.message);
                            progress = data.progress;
                            data.content.forEach(element => {
                                let button = $('<button></button>').addClass(['list-group-item', 'list-group-item-action', 'd-flex', 'justify-content-between', 'align-items-center']);
                                let div = $('<div></div>').addClass('d-flex-row');
                                let name = $('<span></span>').text(element.nama_video);
                                let duration = $('<span></span>').addClass('duration').text(element.durasi_video);
                                div.append(name).append(duration);
                                button.append(div);
                                button.data('id', element.id_video);
                                button.data('file', element.file_video);
                                button.data('order', element.urutan);

                                if(parseInt(element.urutan) > parseInt(data.progress)) {
                                    button.prop('disabled', true);
                                    let lock = $('<div></div>').addClass('d-flex-row');
                                    lock.append($('<i></i>').addClass(['fas', 'fa-fw', 'fa-lock']));
                                    button.append(lock);
                                }
                                
                                $('.list-group').append(button);
                            });
                            
                            removeLoading('.list-group');
                        }
                        else {
                            $('.list-group').empty();
                            showAlert(data);
                        }
                    },
                    error   : function() {
                        $('.list-group').empty();
                        toastr.error('Failed loading content list.', 'Error!');
                    },
                    complete: function() {
                        removeLoading('.list-group');
                    }
                });
            }

            function markFirst() {
                let first = new Object();
                first.id = $(document).find('.list-group-item:first').data('id');
                first.file = $(document).find('.list-group-item:first').data('file');
                first.order = $(document).find('.list-group-item:first').data('order');
                first.index = 0;
                loadVideo(first);
            }

            function updateProgress() {
                return $.ajax({
                    type    : 'post',
                    url     : '<?=base_url('member/video/updateProgress');?>',
                    dataType: 'json',
                    data    : { id: $('video').data('id') },
                    beforeSend: function() {
                        loading('.list-group');
                    },
                    success : function(response) {
                        if(!jQuery.isPlainObject(response)) {
                            window.location = '<?=base_url('member');?>';
                        }
                        else {
                            showAlert(response);
                        }
                    },
                    error   : function(e) {
                        console.log(e.responseText);
                        toastr.error('Failed updating progress.', 'Error!');
                    }
                });
            }

            $(document).ready(function() {
                loadList().then(function() {
                    markFirst();
                });

                $('.list-group').on('click', '.list-group-item', function() {
                    let data = new Object();
                    data.id = $(this).data('id');
                    data.file = $(this).data('file');
                    data.order = $(this).data('order');
                    data.index = $(this).index();
                    loadVideo(data);
                });

                player.on('ended', function() {
                    if($('video').data('order') == progress) {
                        let current = $(document).find('.list-group-item.active').index();
                        updateProgress().then(function() {
                            loadList().then(function() {
                                $(document).find('.list-group-item').eq(current).addClass('active');
                            });
                        });
                    }
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