<?= $this->extend('templates/template') ?>

<?= $this->section('content') ?>

<div class="row mb-5">
    <div class="col-md-8 mx-auto text-center text-light">
        <h1>Data Mahasiswa Universitas Bengkulu</h1>
    </div>
</div>

<div class="row mb-5 col-md-10 mx-auto">
    <div class="col-md-12 d-flex flex-row-reverse">
        <button type="button" class="btn btn-info text-light" id="tambah-mahasiswa">Tambah Mahasiswa +</button>
    </div>
</div>

<div class="row col-md-10 mx-auto">
    <div class="table">
        <table class="table text-light">
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Nomor Telepon</th>
                    <th scope="col">Info</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($data_mahasiswa as $mahasiswa) : ?>
                    <tr>
                        <td class="text-center"><?= $no ?></td>
                        <td><?= $mahasiswa->nama ?></td>
                        <td><?= $mahasiswa->nama_prodi ?></td>
                        <td><?= $mahasiswa->jenis_kelamin ?></td>
                        <td><?= $mahasiswa->alamat ?></td>
                        <td><?= $mahasiswa->no_telp ?></td>
                        <td><?= $mahasiswa->seleksi_masuk . 'MPTN - ' . $bulan[$mahasiswa->bulan_masuk] . ', ' . $mahasiswa->tahun_masuk ?></td>
                        <td>
                            <button type="button" class="btn btn-primary ubah" data-npm="<?= $mahasiswa->npm ?>">Ubah</button>
                            <button type="button" class="btn btn-danger hapus" data-npm="<?= $mahasiswa->npm ?>">Hapus</button>
                        </td>
                    </tr>
                    <?php $no++ ?>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ------------------------ Modal ------------------------ -->
<button hidden data-bs-toggle="modal" data-bs-target="#mahasiswaPopup" id="tombol-popup-mahasiswa"></button>

<div class="modal fade" id="mahasiswaPopup" tabindex="-1" aria-labelledby="titleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="titleLabel">Tambah Data Mahasiswa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="nama" placeholder="Nama Mahasiswa">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="npm" placeholder="NPM Mahasiswa">
                    </div>
                    <select class="form-select mb-3" aria-label="Default select example" id="prodi">
                        <option selected>Pilih Program Studi</option>
                        <?php foreach ($data_prodi as $prodi) : ?>
                            <option value="<?= $prodi->kode_prodi ?>"><?= $prodi->nama_prodi ?></option>
                        <?php endforeach ?>
                    </select>
                    <select class="form-select mb-3" aria-label="Default select example" id="jenis_kelamin">
                        <option selected>Pilih Jenis Kelamin</option>
                        <option value="L">Laki - Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="alamat" placeholder="Alamat Mahasiswa">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="no_telp" placeholder="Nomor Telepon Mahasiswa">
                    </div>
                    <div class="mb-3">
                        <input type="month" class="form-control" id="tanggal_masuk">
                    </div>
                    <select class="form-select mb-3" aria-label="Default select example" id="seleksi_masuk">
                        <option selected>Pilih Jalur Masuk</option>
                        <option value="SN">SNMPTN</option>
                        <option value="SB">SBMPTN</option>
                        <option value="S<">SMMPTN</option>
                    </select>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-aksi="tambah">Close</button>
                <button type="button" id="tombol-simpan-perubahan" class="btn btn-primary" disabled>Simpan</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>