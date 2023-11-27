<div class="modal fade modal-laporan-diskusi" id="modalReport" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <form action="<?= route_to('diskusi.report') ?>" class="modal-content" autocomplete="off" method="POST" id="reportForm">
            
            <?= csrf_field(); ?>
            <input type="hidden" name="pelaku_id" id="pelaku_id">
            <input type="hidden" name="model_id" id="model_id">
            <input type="hidden" name="model_class" id="model_class">

            <div class="modal-header p-2">
                <p class="modal-title ml-2">
                    Laporkan Diskusi
                </p>
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Tutup">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="message">Jenis Masalah:</label>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="message" id="hate" value="Hate">
                        <label class="form-check-label" for="hate">Kebencian</label>
                        <p class="text-muted">Cercaan, Stereotip rasis atau seksis, Dehumanisasi, Menyulut ketakutan atau diskriminasi, Referensi kebencian, Simbol & logo kebencian</p>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="message" id="penhinaan" value="Abuse & Harassment">
                        <label class="form-check-label" for="abuse">Penghinaan & Pelecehan secara Online</label>
                        <p class="text-muted">Penghinaan, Konten Seksual yang Tidak Diinginkan & Objektifikasi Grafis, Konten NSFW & Grafis yang Tidak Diinginkan, Penyangkalan Peristiwa Kekerasan, Pelecehan Bertarget dan Memprovokasi Pelecehan</p>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="message" id="kekerasan" value="Kekerasan">
                        <label class="form-check-label" for="kekerasan">Tutur Kekerasan</label>
                        <p class="text-muted">Ancaman Kekerasan, Berharap Terjadinya Celaka, Mengagungkan Kekerasan, Penghasutan Kekerasan, Penghasutan Kekerasan dengan Kode</p>
                    </div>
                </div>
                
            </div>

            <div class="modal-footer p-1">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Kirim Laporan</button>
            </div>
        </form>
    </div>
</div>

<script src="<?= base_url('js/fe/diskusi/report.js') ?>"></script>