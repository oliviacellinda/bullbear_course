const base_url = {
    index   : 'http://localhost/bullbear_course/',
    admin   : 'http://localhost/bullbear_course/admin/',
    member  : 'http://localhost/bullbear_course/member/',
};

const currency = new Intl.NumberFormat('id-ID', {
    style	: 'currency',
    currency: 'IDR',
    minimumFractionDigits: 2
});

function loading(element) {
    let loading = '<div class="loading"><i class="fas fa-spinner fa-pulse"></i></div>';
    $(element).append(loading);
}

function removeLoading(element) {
    $(element).find('.loading').remove();
}

function showAlert(data) {
    if(data.type == 'success') {
        toastr.success(data.message, 'Success!');
    }
    else if(data.type == 'error') {
        toastr.error(data.message, 'Error!');
    }
    else if(data.type == 'info') {
        toastr.info(data.message, 'Information');
    }
}

function showEllipsis(element) {
    $(element).html('<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>');
}

function removeEllipsis(element) {
    $(element).find('.lds-ellipsis').remove();
}

function scrollToTop() {
    $('html, body').animate({ scrollTop: 0 }, 'slow');
    return false;
}

$(document).on('input', '.input-currency', function() {
    let nilai = $(this).val();
    if(/[^\d]/g.test(nilai)) {
        nilai = nilai.replace(/[^\d]/g, '');
        $(this).val(nilai);
    }

    if(nilai != '') {
        nilai = parseInt(nilai);
        $(this).val(nilai.toLocaleString('id'));
    }
});