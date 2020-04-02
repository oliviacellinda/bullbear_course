function loadCourse(sort = 'asc', search = '', is_owner = false) {
    return $.ajax({
        type    : 'post',
        url     : base_url.member + 'video/getList',
        dataType: 'json',
        data    : {
            sort    : sort,
            search  : search,
            is_owner: is_owner,
        },
        beforeSend: function() {
            showEllipsis('#courseList');
        },
        success: function(data) {
            if(!jQuery.isArray(data)) {
                window.location = base_url.member;
            }
            else if(data.length == 0) {
                let temp = '<p>No data.</p>';
                temp = $.parseHTML(temp);
                $(temp).css('margin', 'auto');
                $(temp).appendTo('#courseList');
            }
            else {
                for(let i=0; i<data.length; i++) {
                    let temp = $('#template')[0].innerHTML;
                    temp = $.parseHTML(temp);
                    $(temp).find('#thumbnail img').attr('src', data[i].thumbnail_paket);
                    $(temp).find('#thumbnail').prop('href', base_url.member + 'video/content/' + data[i].id_video_paket);
                    $(temp).find('#title strong').text(data[i].nama_paket);
                    $(temp).find('#description').text(data[i].deskripsi_singkat);
                    $(temp).find('#price').text(currency.format(data[i].harga_paket));

                    if(is_owner) {
                        $(temp).find('#action').html('<i class="fa fa-pencil"></i> Learn');
                    }
                    else {
                        $(temp).find('#action').html('<i class="fa fa-shopping-cart"></i> Buy');
                    }
                    $(temp).find('#action').prop('href', base_url.member + 'video/content/' + data[i].id_video_paket);

                    $(temp).appendTo('#courseList');
                }
            }
        },
        error   : function(e) {
            console.log(e.responseText);
        },
        complete: function() {
            removeEllipsis('#courseList');
        }
    });
}

function filterContent() {
    let sort = $('#btnFilter').data('sort');
    let search = $('#search').val().trim();
    loadCourse(sort, search, false);
}

$('#btnFilter .dropdown-item').click(function() {
    $('#btnFilter').data('sort', $(this).data('sort'));
    $('#btnFilter').find('button').text($(this).text());
    filterContent();
});

$('#btnSearch').click(function() {
    filterContent();
});