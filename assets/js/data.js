function seeMore(content) {
    let link = base_url.member + content + '/library';
    let button = '<div class="col-12 mt-4 text-center"><a href="#"><button class="btn btn-primary">See More</button></a></div>';
    button = $.parseHTML(button);
    $(button).find('a').prop('href', link);
    $(button).appendTo('#'+content);
}

function loadVideo(template, sort = 'asc', limit = 'all', search = '', is_owner = false, callback) {
    let is_empty = true;
    return $.ajax({
        type    : 'post',
        url     : base_url.member + 'video/list',
        dataType: 'json',
        data    : {
            sort    : sort,
            limit   : limit,
            search  : search,
            is_owner: is_owner,
        },
        beforeSend: function() {
            showEllipsis('.section #video');
        },
        success : function(data) {
            if(data == '' || data == undefined || data == null) {
                let temp = '<p>No data.</p>';
                temp = $.parseHTML(temp);
                $(temp).css('margin', 'auto');
                $(temp).appendTo('.section #video');
            }
            else if(data.length > 0) {
                for(let i=0; i<data.length; i++) {
                    let temp = $(template)[0].innerHTML;
                    temp = $.parseHTML(temp);
                    $(temp).find('#thumbnail').attr('src', data[i].thumbnail_paket);
                    $(temp).find('#title a').text(data[i].nama_paket);
                    $(temp).find('#title a').prop('href', base_url.member + 'video/content/' + data[i].id_video_paket);
                    $(temp).find('#description').text(data[i].deskripsi_singkat);
                    $(temp).find('#price').text(currency.format(data[i].harga_paket));

                    if(is_owner) {
                        $(temp).find('#action').html('<i class="fa fa-pencil"></i> Learn');
                    }
                    else {
                        $(temp).find('#action').html('<i class="fa fa-shopping-cart"></i> Buy');
                    }
                    $(temp).find('#action').prop('href', base_url.member + 'video/content/' + data[i].id_video_paket);

                    $(temp).appendTo('.section #video');
                }
                is_empty = false;
            }
        },
        error   : function(e) {
            console.log(e.responseText);
        },
        complete: function() {
            removeEllipsis('.section #video');
            
            if(!is_empty && callback && typeof callback === 'function') {
                callback();
            }
        }
    });
}

function loadEbook(template, sort = 'asc', limit = 'all', search = '', is_owner = false, callback) {
    let is_empty = true;
    $.ajax({
        type    : 'post',
        url     : base_url.member + 'ebook/list',
        dataType: 'json',
        data    : {
            sort    : sort,
            limit   : limit,
            search  : search,
            is_owner: is_owner,
        },
        beforeSend: function() {
            showEllipsis('.section #ebook');
        },
        success : function(data) {
            if(data == '' || data == undefined || data == null) {
                let temp = '<p>No data.</p>';
                temp = $.parseHTML(temp);
                $(temp).css('margin', 'auto');
                $(temp).appendTo('.section #ebook');
            }
            else if(data.length > 0) {
                for(let i=0; i<data.length; i++) {
                    let temp = $(template)[0].innerHTML;
                    temp = $.parseHTML(temp);
                    $(temp).find('#thumbnail').attr('src', data[i].thumbnail_paket);
                    $(temp).find('#title a').text(data[i].nama_paket);
                    $(temp).find('#title a').prop('href', base_url.member + 'ebook/content/' + data[i].id_ebook_paket);
                    $(temp).find('#description').text(data[i].deskripsi_singkat);
                    $(temp).find('#price').text(currency.format(data[i].harga_paket));

                    if(is_owner) {
                        $(temp).find('#action').html('<i class="fa fa-pencil"></i> Learn');
                    }
                    else {
                        $(temp).find('#action').html('<i class="fa fa-shopping-cart"></i> Buy');
                    }
                    $(temp).find('#action').prop('href', base_url.member + 'ebook/content/' + data[i].id_ebook_paket);

                    $(temp).appendTo('.section #ebook');
                }
                is_empty = false;
            }
        },
        error   : function(e) {
            console.log(e.responseText);
        },
        complete: function(data) {
            removeEllipsis('.section #ebook');

            if(!is_empty && callback && typeof callback === 'function') {
                callback();
            }
        }
    });
}

function filterContent(text) {
    let sort = $('#btnFilter').data('sort');
    let url = window.location.href;
    segment = url.split('/');

    let search = $('#search').val().trim();

    // if( segment.findIndex(arr => arr === 'home') !== -1 ) {
    //     loadVideo(sort, 3, search, false, function(){seeMore('video')} );
    //     loadEbook(sort, 3, search, false, function(){seeMore('ebook')} );
    // }
    if(segment.findIndex(arr => arr === 'video') !== -1) {
        loadVideo('#template-ver-01', sort, 'all', search, false, '' );
    }
    else if(segment.findIndex(arr => arr === 'ebook') !== -1) {
        loadVideo('#template-ver-01', sort, 'all', search, false, '' );
    }

    $('#btnFilter').find('button').text(text);
}

$('#btnFilter .dropdown-item').click(function() {
    $('#btnFilter').data('sort', $(this).data('sort'));
    filterContent($(this).text());
});

$('#btnSearch').click(function() {
    filterContent();
});