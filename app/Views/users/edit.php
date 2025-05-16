<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit User<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit User</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="/users">Manajemen User</a></li>
        <li class="breadcrumb-item active">Edit User</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-user-edit me-1"></i>
            Form Edit User
        </div>
        <div class="card-body">
            <form action="/users/update/<?= $user['iduser'] ?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $user['nama'] ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
<<<<<<< HEAD
                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
=======
                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
                            <small class="text-muted">Opsional untuk karyawan. Jika dikosongkan, akan menggunakan format: namakaryawan@sinamedika.com</small>
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
<<<<<<< HEAD
                            <label for="password">Password (kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" id="password" name="password">
=======
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_kartu_rfid">ID Kartu RFID</label>
                            <input type="text" class="form-control" id="id_kartu_rfid" name="id_kartu_rfid" value="<?= $user['id_kartu_rfid'] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="karyawan" <?= $user['role'] == 'karyawan' ? 'selected' : '' ?>>Karyawan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="aktif" <?= $user['status'] == 'aktif' ? 'selected' : '' ?>>Aktif</option>
                                <option value="tidak aktif" <?= $user['status'] == 'tidak aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gender">Jenis Kelamin</label>
                            <select class="form-control" id="gender" name="gender" required>
                                <option value="laki-laki" <?= $user['gender'] == 'laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="perempuan" <?= $user['gender'] == 'perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="/users" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
<<<<<<< HEAD
=======

<script>
    document.getElementById('role').addEventListener('change', function() {
        const passwordField = document.getElementById('password');
        const emailField = document.getElementById('email');
        const passwordHelp = document.createElement('small');
        const emailHelp = document.createElement('small');

        passwordHelp.className = 'text-muted';
        emailHelp.className = 'text-muted';

        if (this.value === 'karyawan') {
            passwordField.removeAttribute('required');
            emailField.removeAttribute('required');
            passwordHelp.textContent = 'Opsional untuk karyawan. Jika dikosongkan, password tidak akan diubah';
            emailHelp.textContent = 'Opsional untuk karyawan. Jika dikosongkan, akan menggunakan format: namakaryawan@sinamedika.com';
        } else {
            passwordField.setAttribute('required', '');
            emailField.setAttribute('required', '');
            passwordHelp.textContent = '';
            emailHelp.textContent = '';
        }

        // Remove existing help text if any
        const existingPasswordHelp = passwordField.nextElementSibling;
        const existingEmailHelp = emailField.nextElementSibling;
        if (existingPasswordHelp && existingPasswordHelp.tagName === 'SMALL') {
            existingPasswordHelp.remove();
        }
        if (existingEmailHelp && existingEmailHelp.tagName === 'SMALL') {
            existingEmailHelp.remove();
        }

        // Add new help text
        passwordField.parentNode.appendChild(passwordHelp);
        emailField.parentNode.appendChild(emailHelp);
    });

    // Trigger change event on page load
    document.getElementById('role').dispatchEvent(new Event('change'));
</script>
>>>>>>> b265b755a65f585b5ed6e3087633f37ee5c2a3da
<?= $this->endSection() ?>