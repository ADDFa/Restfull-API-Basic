// TODO: Global function
const el = element => document.querySelector(`${element}`)
const elAll = element => document.querySelectorAll(`${element}`)

const xhr = new XMLHttpRequest
const date = new Date

// TODO: My Code
const validateError = val => {
    el('#tombol-simpan-perubahan').setAttribute('disabled', '')
    return val.classList.add('validate-error')
}

const validateValid = val => {
    val.classList.remove('validate-error')

    const input = [...elAll('#mahasiswaPopup input')]
    const select = [...elAll('#mahasiswaPopup select')]

    const cek = input.concat(select)
    let status = 'valid'
    cek.map(e => {
        if (e.value.length < 1) status = 'noValid'
    })

    if (status === 'valid') el('#tombol-simpan-perubahan').removeAttribute('disabled')
}

const validateLength = (input, length) => {
    if (input.value.length === 0) return validateError(input)
    if (input.value.length > length) return validateError(input)

    return validateValid(input)
}

el('#mahasiswaPopup').addEventListener('input', e => {
    if (e.target === el('#nama')) return validateLength(e.target, 100)
    if (e.target === el('#npm')) return validateLength(e.target, 9)
    if (e.target === el('#prodi')) return validateLength(e.target, 5)
    if (e.target === el('#jenis_kelamin')) return validateLength(e.target, 2)
    if (e.target === el('#alamat')) return validateLength(e.target, 1000)
    if (e.target === el('#no_telp')) return validateLength(e.target, 20)
    if (e.target === el('#tanggal_masuk')) return validateLength(e.target, 7)
    if (e.target === el('#seleksi_masuk')) return validateLength(e.target, 2)
})

el('#tombol-simpan-perubahan').addEventListener('click', e => {
    const form = e.target.parentElement.parentElement.querySelector('form')
    const dataAction = form.getAttribute('data-action')

    const data = {
        'nama': form.querySelector('#nama').value,
        'npm': form.querySelector('#npm').value,
        'prodi': form.querySelector('#prodi').value,
        'jenis_kelamin': form.querySelector('#jenis_kelamin').value,
        'alamat': form.querySelector('#alamat').value,
        'no_telp': form.querySelector('#no_telp').value,
        'tahun_masuk': form.querySelector('#tanggal_masuk').value.split('-')[0],
        'bulan_masuk': form.querySelector('#tanggal_masuk').value.split('-')[1],
        'seleksi_masuk': form.querySelector('#seleksi_masuk').value
    }

    console.log(dataAction)
})

el('#mahasiswaPopup .btn-close').addEventListener('click', () => el('#mahasiswaPopup form').removeAttribute('data-action'))

el('#tambah-mahasiswa').addEventListener('click', () => {
    el('#mahasiswaPopup form').setAttribute('data-action', 'insert')

    const input = [...elAll('#mahasiswaPopup input')]
    const select = [...elAll('#mahasiswaPopup select')]

    input.map(e => e.value = '')
    select.map(e => {
        e.querySelector('[selected]').removeAttribute('selected', '')
        e.querySelector('option:first-child').setAttribute('selected', '')
    })

    el('#tombol-popup-mahasiswa').click()
})

const ubahMahasiswa = target => {
    el('#mahasiswaPopup form').setAttribute('data-action', 'update')

    const npm = target.getAttribute('data-npm')
    const data = {
        'npm': npm
    }

    const invalid = () => {
        Swal.fire(
            'Mahasiswa Tidak Ditemukan',
            'Apakah NPM Mahasiswa Telah Terdaftar?',
            'question'
        )
    }

    const selectedItem = (target, val) => target.querySelector(`[value="${val}"]`).setAttribute('selected', '')

    const success = data => {
        el('#tombol-popup-mahasiswa').click()
        const datas = JSON.parse(data)

        const popupMahasiswa = el('#mahasiswaPopup')
        const title = popupMahasiswa.querySelector('#titleLabel')
        const nama = popupMahasiswa.querySelector('#nama')
        const npm = popupMahasiswa.querySelector('#npm')
        const prodi = popupMahasiswa.querySelector('#prodi')
        const jenis_kelamin = popupMahasiswa.querySelector('#jenis_kelamin')
        const alamat = popupMahasiswa.querySelector('#alamat')
        const no_telp = popupMahasiswa.querySelector('#no_telp')
        const tanggal_masuk = popupMahasiswa.querySelector('#tanggal_masuk')
        const seleksi_masuk = popupMahasiswa.querySelector('#seleksi_masuk')

        title.innerText = 'Ubah Data Mahasiswa'
        nama.value = datas.nama
        npm.value = datas.npm
        selectedItem(prodi, datas.prodi)
        selectedItem(jenis_kelamin, datas.jenis_kelamin)
        alamat.value = datas.alamat
        no_telp.value = datas.no_telp
        const tanggal = (datas.bulan_masuk.length < 2) ? datas.tahun_masuk + '-0' + datas.bulan_masuk : datas.tahun_masuk + '-' + datas.bulan_masuk
        tanggal_masuk.value = tanggal
        selectedItem(seleksi_masuk, datas.seleksi_masuk)
    }

    // TODO: Ambil data mahasiswa berdasarkan NPM
    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
            (xhr.response) ? success(xhr.response): invalid()
        }
    }

    xhr.open('POST', `${origin}/mahasiswa/show`, true)
    xhr.send(JSON.stringify(data))
}

const hapusMahasiswa = target => {
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data Akan Dihapus Secara Permanent!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            const key = target.getAttribute('data-npm')

            console.log(key)
        }
    })
}

el('.table').addEventListener('click', e => {
    if (e.target.classList.contains('ubah')) ubahMahasiswa(e.target)
    if (e.target.classList.contains('hapus')) hapusMahasiswa(e.target)

    return
})