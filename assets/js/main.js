const flashData = $('.flash-data').data('flashdata');
if( flashData ){
  Swal.fire({
    title: 'Data mahasiswa ',
    text: 'Berhasil ' + flashData,
    icon: 'success'
  });
}

// tombol-hapus
$('.tombol-hapus').on('click', function(e) {
  e.preventDefault();
  // ambil tombol yang sedang dipencet
  const href = $(this).attr('href');
  Swal.fire({
    title: "Yakin menghapus?",
    text: "Data akan terhapus permanent",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus data!"
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = href;
    }
  });
});