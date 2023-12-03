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
        var model = $this.data('model');
        var url = `${origin}/like-thread`;

        $.ajax({
            type: "POST",
            url: url,
            data: {
                model: model,
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
                var all = document.querySelectorAll(`[data-model="${model}"]`);
                all.forEach((el) => {
                    var small = $(el).find("small");
                    var count = small.html();

                    $(el).removeClass().addClass(res.btnClassAttr);
                    $(el).find("i").removeClass().addClass(res.iconClassAttr);

                    res.likeStatus === "like" ? small.html(parseInt(count) + 1) : small.html(parseInt(count) - 1);
                });
            }
        });
    });
});