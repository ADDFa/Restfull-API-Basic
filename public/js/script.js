// TODO: Global function
const el = element => document.querySelector(`${element}`)
const elAll = element => document.querySelectorAll(`${element}`)

const xhr = new XMLHttpRequest
const date = new Date

// 


// TODO: XHR Ready and Success


// 

const xhrReady = func => {
    xhr.onreadystatechange = () => {
        if (xhr.status === 200 && xhr.readyState === 4) {
            func(xhr.response)
        }
    }
}

// 


// TODO: Validasi


// 
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

// 


// TODO: Refresh


// 

const refresh = () => {
    xhrReady(function (response) {
        let data = ''
        let no = 1
        JSON.parse(response).forEach(e => {
            data +=
                /* html */
                `
                <tr>
                    <td class="text-center">${no}</td>
                    <td>${e.nama}</td>
                    <td>${e.nama_prodi}</td>
                    <td>${e.jenis_kelamin}</td>
                    <td>${e.alamat}</td>
                    <td>${e.no_telp}</td>
                    <td>${e.seleksi_masuk}MPTN - ${parseInt(e.bulan_masuk) - 1}, ${e.tahun_masuk}</td>
                    <td>
                        <button type="button" class="btn btn-primary ubah" data-npm="${e.npm}">Ubah</button>
                        <button type="button" class="btn btn-danger hapus" data-npm="${e.npm}">Hapus</button>
                    </td>
                </tr>
                `

            no++
        })

        el('.tabel-mahasiswa tbody').innerHTML = data

        Swal.fire(
            'Berhasil',
            'Data Mahasiswa Diperbaharui',
            'success'
        )
    })

    xhr.open('POST', `${origin}/mahasiswa/get`, true)
    xhr.send()
}


// 


// TODO: CRUD Succes


// 

const crudSuccess = () => {
    xhrReady(function () {
        el('#mahasiswaPopup .btn-close').click()
        refresh()
    })
}

// 


// TODO: Close button


// 

el('#mahasiswaPopup .btn-close').addEventListener('click', () => el('#mahasiswaPopup form').removeAttribute('data-action'))
el('#mahasiswaPopup #close').addEventListener('click', () => el('#mahasiswaPopup form').removeAttribute('data-action'))

// 


// TODO: Save


// 

el('#tombol-simpan-perubahan').addEventListener('click', e => {
    const form = e.target.parentElement.parentElement.querySelector('form')
    const dataAction = form.getAttribute('data-action')
    const npm = {
        'npm': form.getAttribute('data-npm')
    }

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

    if (dataAction === 'update') Object.assign(data, npm)

    crudSuccess()

    xhr.open('POST', `${origin}/mahasiswa/${dataAction}`)
    xhr.send(JSON.stringify(data))
})


// 


// TODO: Insert


// 

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


// 


// TODO: Update


// 

const ubahMahasiswa = target => {
    const npm = target.getAttribute('data-npm')

    el('#mahasiswaPopup form').setAttribute('data-action', 'update')
    el('#mahasiswaPopup form').setAttribute('data-npm', npm)

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
    xhrReady(function () {
        (xhr.response) ? success(xhr.response): invalid()
    })

    xhr.open('POST', `${origin}/mahasiswa/show`, true)
    xhr.send(JSON.stringify(data))
}


// 


// TODO: Delete


// 


const hapusMahasiswa = target => {
    Swal.fire({
        title: 'Apakah Anda Yakin?',
        text: "Data Akan Dihapus Secara Permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus'
    }).then((result) => {
        if (result.isConfirmed) {
            const data = {
                npm: target.getAttribute('data-npm')
            }

            crudSuccess()

            xhr.open('POST', `${origin}/mahasiswa/delete`, true)
            xhr.send(JSON.stringify(data))
        }
    })
}


// 


// TODO: Action


// 

el('.table').addEventListener('click', e => {
    if (e.target.classList.contains('ubah')) ubahMahasiswa(e.target)
    if (e.target.classList.contains('hapus')) hapusMahasiswa(e.target)

    return
})