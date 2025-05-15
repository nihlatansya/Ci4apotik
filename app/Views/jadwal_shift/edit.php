<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Jadwal Shift<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Jadwal Shift</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/jadwal-shift">Jadwal Shift</a></li>
        <li class="breadcrumb-item active">Edit Jadwal</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Form Edit Jadwal Shift
        </div>
        <div class="card-body">
            <form action="/jadwal-shift/update/<?= $jadwal_shift['id_jadwal_shift'] ?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dari_tanggal">Dari Tanggal</label>
                            <input type="date" class="form-control" id="dari_tanggal" name="dari_tanggal" value="<?= $jadwal_shift['dari_tanggal'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sampai_tanggal">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="sampai_tanggal" name="sampai_tanggal" value="<?= $jadwal_shift['sampai_tanggal'] ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="shift_mulai">Shift Mulai</label>
                            <input type="time" class="form-control" id="shift_mulai" name="shift_mulai" value="<?= $jadwal_shift['shift_mulai'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="shift_selesai">Shift Selesai</label>
                            <input type="time" class="form-control" id="shift_selesai" name="shift_selesai" value="<?= $jadwal_shift['shift_selesai'] ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="jenis_shift">Jenis Shift</label>
                    <select class="form-control" id="jenis_shift" name="jenis_shift" required>
                        <option value="pagi" <?= $jadwal_shift['jenis_shift'] == 'pagi' ? 'selected' : '' ?>>Pagi</option>
                        <option value="siang" <?= $jadwal_shift['jenis_shift'] == 'siang' ? 'selected' : '' ?>>Siang</option>
                        <option value="malam" <?= $jadwal_shift['jenis_shift'] == 'malam' ? 'selected' : '' ?>>Malam</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/jadwal-shift" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>