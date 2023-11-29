$(document).ready(function () {
    var buttonDraft = $(".btn-draft-diskusi");
    var buttonPublish = $(".btn-publish-diskusi");

    buttonDraft.on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");
        var url = `${origin}/draft-thread`;

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
                    showLoader("Tunggu sebentar ya, diskusi kamu sedang diarsip...");
                    location.reload();
                }
            }
        });
    });

    buttonPublish.on("click", function(e) {
        e.preventDefault();

        var id = $(this).data("id");
        var url = `${origin}/publish-thread`;
        
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
                    showLoader("Tunggu sebentar ya, diskusi kamu sedang dipublish...");
                    location.reload();
                }
            }
        });
    });
});