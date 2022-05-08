$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.clickable', function (event) {
    $('.loader-overlay').removeClass('d-none')
});

$('form').on('submit', function (event) {
    $('.loader-overlay').removeClass('d-none')
});
