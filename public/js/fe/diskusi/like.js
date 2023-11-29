$(document).ready(function () {
    var buttonSuka = $(".btn-suka-diskusi");
    var logined = buttonSuka.data("logined");
    
    buttonSuka.on("click", function (e) {
        e.preventDefault();

        if (!logined) {
            alertifyLog('default', 'Kamu harus login terlebih dahulu untuk menyukai diskusi ini.', () => {
                $("body").css('overflow', 'auto');
            });
            return;
        }

        var $this = $(this);
        var idModel = $this.data('id');
        var classModel = $this.data('class');
        var url = `${origin}/like-thread`;

        $.ajax({
            type: "POST",
            url: url,
            data: {
                id: idModel,
                class: classModel
            },
            dataType: "json",
        }).done(function (res) {
            if (res.status === 400) {
                alertifyLog('error', res.message, (e) => {
                    if (res.reload) {
                        showLoader("Tunggu sebentar ya, sedang memuat ulang halaman..");
                        location.reload();
                    }
                    $("body").css("overflow", "auto");
                });
            } else {
                var small = $this.find("small");
                var count = small.html();
    
                $this.removeClass().addClass(res.btnClassAttr);
                $this.find("i").removeClass().addClass(res.iconClassAttr);
    
                res.likeStatus === "like" ? small.html(parseInt(count) + 1) : small.html(parseInt(count) - 1);
            }
        });
    });
});