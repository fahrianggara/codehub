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
                        alertifyLog('error', res.message, (e) => {
                            $("body").css("overflow", "auto");
                        });
                    } else {
                        showLoader("Tunggu sebentar ya, diskusi kamu sedang dihapus...");
                        location.reload();
                    }
                }
            });
        };

        alertifyConfirm('Apakah kamu ingin menghapus diskusi ini?', confirm, cancel, 'IYA HAPUS');
    })
});