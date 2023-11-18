$(document).ready(function () {
    var buttonDelete = $(".btn-hapus-diskusi");

    buttonDelete.on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");
        var url = `${origin}/destroy-thread`;
        var cancel = (e) => {
            $('body').removeClass('modal-open');
        };
        var confirm = (e) => {
            $.ajax({
                type: "POST",
                url: url,
                data: {id: id},
                dataType: "json",
                success: function (res) {
                    if (res.status === 400) {
                        alertifyLog('error', res.message);
                    } else {
                        alertifyLog('success', res.message, (e) => {
                            location.reload();
                        });
                    }
                }
            });
        };

        alertifyConfirm('Apakah kamu ingin menghapus diskusi ini?', confirm, cancel, 'Iya, hapus', 'Gak, jangan');
    })
});