$(document).ready(function () {
    var buttonDraft = $(".btn-draft-diskusi");
    var buttonPublish = $(".btn-publish-diskusi");

    buttonDraft.on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");
        var url = `${origin}/draft-thread`;
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
                            $(".body").css("overflow", "auto");
                        });
                    } else {
                        alertifyLog('success', res.message, (e) => {
                            location.reload();
                        });
                    }
                }
            });
        };

        alertifyConfirm('Apakah kamu ingin arsip diskusi ini?', confirm, cancel, 'IYA ARSIPKAN');
    });

    buttonPublish.on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");
        var url = `${origin}/publish-thread`;
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
                            $(".body").css("overflow", "auto");
                        });
                    } else {
                        alertifyLog('success', res.message, (e) => {
                            location.reload();
                        });
                    }
                }
            });
        };

        alertifyConfirm('Apakah kamu ingin mempublish diskusi ini?', confirm, cancel, 'IYA PUBLISH');
    });
});