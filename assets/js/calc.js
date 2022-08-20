function startCalc() {
	interval = setInterval("calc()", 1);
}
function calc() {
	pajak = document.detail.pajak.value;
	diskon = document.detail.diskon.value;
	biaya_tambahan = document.detail.biaya_tambahan.value;
	harga_paket = document.detail.harga_paket.value;
	harga_awal = parseInt(harga_paket) + parseInt(pajak) + parseInt(biaya_tambahan);
	harga_diskon = (parseInt(diskon) / 100) * parseInt(harga_awal);
	total_biaya = parseInt(harga_awal) - parseInt(harga_diskon);
	document.detail.total_biaya.value = 
	new Intl.NumberFormat('id-IN',{
		style: 'currency',
		currency: 'IDR',
		minimumFractionDigits: 0,
	}).format(total_biaya)
}
function stopCalc() {
	clearInterval(interval);
}
