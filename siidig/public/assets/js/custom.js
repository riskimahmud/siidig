// mengganti alert notifikasi menjadi toast
const statusFlashData = $('.flash-data').data('statusflashdata');
const msgFlashData = $('.flash-data').data('msgflashdata');

// console.log(statusFlashData);
if (statusFlashData) {
	if (statusFlashData == "danger") {
		toastr.error(msgFlashData, 'Gagal!', {
			"showMethod": "slideDown",
			"hideMethod": "slideUp",
			"icon": "fas fa-times",
			timeOut: 5000,
			"positionClass": "toast-bottom-left",
		});
	} else {
		toastr.success(msgFlashData, 'Berhasil.', {
			"showMethod": "slideDown",
			"hideMethod": "slideUp",
			"icon": "fas fa-check-double",
			timeOut: 5000,
			"positionClass": "toast-bottom-left",
		});
	}
}

// konfirmasi hapus
$('.delete').on('click', function (e) {
	e.preventDefault();
	const link = $(this).attr("href");
	Swal.fire({
		title: 'Apakah anda yakin?',
		text: "Data akan dihapus dari aplikasi",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya. Hapus data!',
		confirmButtonClass: 'btn btn-warning',
		cancelButtonClass: 'btn btn-danger ml-1',
		cancelButtonText: 'Batal',
		buttonsStyling: false,
	}).then(function (result) {
		if (result.value) {
			document.location.href = link;
		}
	})
});

$("#dataTable").DataTable({
	"responsive": true,
	"autoWidth": false,
	"language":{
		"url":"//cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
		"sEmptyTable": "Tidads"
	}
});

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.select2-alt').select2({
		allowClear: true
	})

	// const moment = moment();
	// const date = moment($('.datepicker').val(), 'YYYY-MM-DD').toDate();
    $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
    });
});

// konfirmasi keluar
$('.keluar').on('click', function (e) {
	e.preventDefault();
	const link = $(this).attr("href");
	Swal.fire({
		title: 'Apakah anda yakin?',
		text: "Ingin keluar dari aplikasi",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya. Keluar!',
		confirmButtonClass: 'btn btn-primary',
		cancelButtonClass: 'btn btn-danger ml-1',
		cancelButtonText: 'Batal',
		buttonsStyling: false,
	}).then(function (result) {
		if (result.value) {
			document.location.href = link;
		}
	})
});

$('.datepicker').datetimepicker({
	format: 'YYYY-MM-DD',
	defaultDate: false
});