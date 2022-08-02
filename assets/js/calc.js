function startCalc() {
	interval = setInterval("calc()", 1);
}
function calc() {
	harga_paket = document.detail.harga_paket.value;
	pajak = document.detail.pajak.value;
	diskon = document.detail.diskon.value;
	biaya_tambahan = document.detail.biaya_tambahan.value;
	jumlah_paket = document.detail.jumlah_paket.value;
	harga_awal =
		parseInt(harga_paket) * parseInt(jumlah_paket) +
		parseInt(pajak) +
		parseInt(biaya_tambahan);
	harga_diskon = (parseInt(diskon) / 100) * parseInt(harga_awal);

	document.detail.total_biaya.value =
		parseInt(harga_awal) - parseInt(harga_diskon);
}
function stopCalc() {
	clearInterval(interval);
}
