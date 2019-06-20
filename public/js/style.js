$(document).ready(function(){

    $('.modal').on('shown.bs.modal', function() {
        $(document).off('focusin.modal');
    });

    $('body').on('click', '.btn-show', function(e){
        e.preventDefault();

        var me = $(this);

        $('.modal-title').html(me.data('title'));
        me.hasClass('need-lg') ? $('.modal-dialog').addClass('modal-lg') : $('.modal-dialog').removeClass('modal-lg');
        me.hasClass('btn-primary') || me.hasClass('btn-success') ? $('#btn-submit').html('Save') : $('#btn-submit').html('Update Change');
        me.hasClass('btn-detail') ? $('#btn-submit').hide() : $('#btn-submit').show();

        $.get(me.attr('href'), function(res){
            $('.modal-body').html(res);
        });

        $('.modal').modal('show');
    });

    $('body').on('click', '#btn-submit', function(e){
        e.preventDefault();

        $('.form-submit').submit();
    });

    $('body').on('submit', '.form-submit', function(e){
        e.preventDefault();

        var me = $(this),
            url = me.attr('action');

        $.ajax({
            url: url,
            method: 'POST',
            data: new FormData(me[0]),
            cache: false,
            contentType: false,
            processData: false,
            success: function(res)
            {
                if(me.hasClass('need-refresh')) return location.reload();

                swal({
                    title: "Good job!",
                    text: res,
                    icon: "success",
                    button: "Aww yiss!",
                });

                $('.modal').modal('hide');
                (me.hasClass('no-load')) ? '' : $('#datatable').DataTable().ajax.reload();
            },
            error: function(res)
            {
                var err = res.responseJSON;

                $('.text-danger').remove();

                $.each(err.errors, function(key, value){
                    var div = $('#'+key);

                    div.closest('.form-group')
                        .append('<strong class="text-danger">'+ value +'</strong>');
                })
            },
        });
    });

    $('body').on('click', '.btn-delete', function(e){
        e.preventDefault();

        var me = $(this),
            token = $('meta[name=csrf-token]').attr('content');

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                        url: me.attr('href'),
                        method: 'POST',
                        data: {
                            _token: token,
                            _method: 'DELETE'
                        },
                        success: function(res)
                        {
                            swal("Poof! "+res, {
                                icon: "success",
                            });
                            $('#datatable').DataTable().ajax.reload();
                            // console.log(res.responseJSON);
                        },
                        error: function(res)
                        {
                            alert("Gagal menghapus data!");
                            // console.log(res.responseJSON);
                        }
                });
            } else {
                swal("Your imaginary file is safe!");
            }
        });
    });

    $('#keyword').on('keyup', function(){
        var key = $(this).val();
        console.log(key);

        $.ajax({
            url: base_url + '/masakan/search/' + key,
            method: 'GET',
            success: function(res)
            {
                $('#feed-makanan').html('');

                if (res == '')
                {
                    $('#feed-makanan').html(`
                    <div class="col-md-6 offset-md-5 col-sm-6 offset-sm-5">
                        <h3>Makanan tidak ditemukan.</h3>
                    </div>
                    `);
                }
                else
                {
                    $('#feed-makanan').html(res);
                }
            },
            error: function(res)
            {
                console.log(err.responseJSON);
            }
        });
    });
});

$(document).on('click', '.page-link', function(e){
    e.preventDefault();

    let link = $(this).attr('href');
    const pg = link.split('page='),
          kw = $('#keyword').val();

    $.ajax({
        url: '/masakan/search/'+kw+'?page='+pg[1],
        method: 'GET',
        success: function(res){
            $('#feed-makanan').html(res);
        },
        error: function(err){
            console.log(err);
        }
    })

});

function formatRupiah(angka){
    angka = angka.toString();
    var negative = false;
    if(angka[0] == '-') negative = true;

    var number_string = angka.replace(/[^,\d]/g, ''),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return (negative == true) ? "-" + rupiah : rupiah;
}
