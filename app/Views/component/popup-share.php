<div class="popup-share">
    <div class="popup-share-container">
        <div class="popup-share-header">
            <h3>Bagikan Diskusi</h3>
            <button type="button" class="popup-share-close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="popup-share-body">
            <div class="field">
                <div class="title">
                    <h4>Bagikan ke Sosial Media</h4>
                </div>
                <div class="content link-social">
                <div class="item">
                        <a href="javascript:void(0);" class="item-link fb-link">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="javascript:void(0);" class="item-link tw-link">
                            <i class="fab fa-twitter"></i>
                            <span>Twitter</span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="javascript:void(0);" class="item-link wa-link">
                            <i class="fab fa-whatsapp"></i>
                            <span>Whatsapp</span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="javascript:void(0);" class="item-link tg-link">
                            <i class="fab fa-telegram-plane"></i>
                            <span>Telegram</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="field">
                <div class="title">
                    <h4>Atau Salin Link</h4>
                </div>
                <div class="content copy-link">
                    <i class="fas fa-link"></i>
                    <input type="text" readonly>
                    <button type="button" class="btn-copy">
                        <i class="fas fa-copy"></i>
                        <span>Salin Link</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="popup-share-footer">
            <button type="button" class="popup-share-close">
                Tutup
            </button>
        </div>
    </div>
</div>

<?= $this->section('js') ?>

<script>
    $(document).ready(function () {
        var popupShare = $('.popup-share');
        var popupShareBtn = $('.btn-share-diskusi');
        var popupShareClose = $('.popup-share-close');
        var popupShareCopyBtn = $('.popup-share .copy-link .btn-copy');
        var popupShareCopyInput = $('.popup-share .copy-link input');

        popupShareBtn.on('click', function() {
            var url = $(this).data('url');

            popupShare.addClass('active');
            popupShareCopyInput.val(url);

            popupShare.find('.fb-link').attr('onclick', 'shareOnFacebook("' + url + '")');
            popupShare.find('.tw-link').attr('onclick', 'shareOnTwitter("' + url + '")');
            popupShare.find('.wa-link').attr('onclick', 'shareOnWhatsapp("' + url + '")');
            popupShare.find('.tg-link').attr('onclick', 'shareOnTelegram("' + url + '")');

            $('body').addClass('overflow-hidden');
        });

        popupShareClose.on('click', function() {
            popupShare.removeClass('active');
            $('body').removeClass('overflow-hidden');
        });

        popupShareCopyBtn.on('click', function() {
            popupShareCopyInput.select();

            if (document.execCommand('copy')) {
                $(this).addClass('active');
                $(this).find('span').text('Tersalin');
                $(this).find('i').removeClass('fa-copy').addClass('fa-check');
                $(this).parent().addClass('active');

                setTimeout(() => {
                    window.getSelection().removeAllRanges();
                    $(this).removeClass('active');
                    $(this).find('span').text('Salin Link');
                    $(this).find('i').removeClass('fa-check').addClass('fa-copy');
                    $(this).parent().removeClass('active');
                }, 1000);
            }
        });

        shareOnFacebook = (url) => {
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, 'facebook-share-dialog', 'width=626,height=436');
        }

        shareOnTwitter = (url) => {
            window.open(`https://twitter.com/intent/tweet?url=${url}`, 'twitter-share-dialog', 'width=626,height=436');
        }

        shareOnWhatsapp = (url) => {
            window.open(`https://api.whatsapp.com/send?text=${url}`, 'whatsapp-share-dialog', 'width=626,height=436');
        }

        shareOnTelegram = (url) => {
            window.open(`https://telegram.me/share/url?url=${url}`, 'telegram-share-dialog', 'width=626,height=436');
        }
    });
</script>

<?= $this->endSection() ?>