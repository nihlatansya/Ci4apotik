<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Presensi<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="card-title mb-0">Data Presensi</h4>
            <div>
                <a href="/presensi/create" class="btn btn-primary me-2">
                    <i class="fas fa-plus"></i> Tambah Presensi
                </a>
                <a href="/presensi/exportCsv" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export CSV
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Nama Karyawan</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($presensi as $row): ?>
                        <tr>
                            <td><?= $row['id_presensi'] ?></td>
                            <td><?= $row['tanggal'] ?></td>
                            <td><?= $row['nama'] ?></td>
                            <td><?= $row['jam_masuk'] ?></td>
                            <td><?= $row['jam_pulang'] ?></td>
                            <td>
                                <span class="badge bg-<?= $row['keterangan'] === 'hadir' ? 'success' : ($row['keterangan'] === 'telat' ? 'warning' : 'danger') ?>">
                                    <?= ucfirst($row['keterangan']) ?>
                                </span>
                            </td>
                            <td>
                                <a href="/presensi/edit/<?= $row['id_presensi'] ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/presensi/delete/<?= $row['id_presensi'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- RFID Scanner Modal -->
<div class="modal fade" id="rfidModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Scan RFID</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="rfid" class="form-label">ID Kartu RFID</label>
                    <input type="text" class="form-control" id="rfid" name="rfid" autofocus>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="scanRfid()">Scan</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    function scanRfid() {
        const rfid = document.getElementById('rfid').value;

        fetch('/presensi/scanRfid', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    rfid: rfid
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memproses RFID');
            });
    }

    // Auto focus on RFID input when modal opens
    document.getElementById('rfidModal').addEventListener('shown.bs.modal', function() {
        document.getElementById('rfid').focus();
    });
</script>
<?= $this->endSection() ?>