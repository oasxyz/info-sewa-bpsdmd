const gedungSelect = document.querySelector('select[name="gedung"]');
const tanggalInput = document.querySelector('input[name="tanggal_pemakaian"]');
const waktuSiang = document.getElementById('waktuSiang');
const waktuMalam = document.getElementById('waktuMalam');
const waktuSehari = document.getElementById('waktuSehari');

const warningBox = document.createElement('div');
warningBox.className = 'alert alert-warning mt-2';
warningBox.style.display = 'none';
tanggalInput.closest('.col-md-6').appendChild(warningBox);

let hariLiburCache = {};

async function fetchHariLibur(tahun) {
    if (hariLiburCache[tahun]) return hariLiburCache[tahun];
    try {
        const res = await fetch(`https://api-hari-libur.vercel.app/api?year=${tahun}`);
        const resJson = await res.json();
        const data = resJson.data;
        const tanggalLibur = {};
        data.forEach(item => { tanggalLibur[item.date] = true; });
        hariLiburCache[tahun] = tanggalLibur;
        return tanggalLibur;
    } catch {
        return {};
    }
}

function isValidForSasana(dateStr, liburMap) {
    if (!dateStr) return { valid: false, reason: '' };
    const d = new Date(dateStr + 'T00:00:00');
    const day = d.getDay();
    const isSabtu = day === 6;
    const isMinggu = day === 0;
    const isJumat = day === 5;
    const isLibur = liburMap[dateStr] === true;

    if (isSabtu || isMinggu || isLibur) return { valid: true, reason: 'all' };
    if (isJumat) return { valid: true, reason: 'malam_only' };
    return { valid: false, reason: 'dilarang' };
}

async function validateForm() {
    const gedung = gedungSelect.value;
    const tanggal = tanggalInput.value;

    warningBox.style.display = 'none';
    waktuSiang.disabled = false;
    waktuMalam.disabled = false;
    waktuSehari.disabled = false;
    tanggalInput.removeAttribute('title');

    if (gedung !== 'Balai Sasana Widya Praja') return;

    if (!tanggal) {
        warningBox.innerHTML = '<strong>Info:</strong> Gedung Sasana Widya Praja hanya dapat disewa pada hari <strong>Jumat (khusus sesi malam), Sabtu, Minggu, dan hari libur nasional</strong>.';
        warningBox.style.display = 'block';
        return;
    }

    const tahun = tanggal.substring(0, 4);
    const liburMap = await fetchHariLibur(tahun);
    const result = isValidForSasana(tanggal, liburMap);

    if (!result.valid) {
        warningBox.innerHTML = '<strong>Tanggal tidak tersedia.</strong> Gedung Sasana Widya Praja hanya dapat disewa pada hari <strong>Jumat (khusus sesi malam), Sabtu, Minggu, dan hari libur nasional</strong>.';
        warningBox.style.display = 'block';
        tanggalInput.setAttribute('title', 'Tanggal tidak valid untuk gedung ini');
        return;
    }

    if (result.reason === 'malam_only') {
        waktuSiang.disabled = true;
        waktuMalam.checked = true;
        waktuSehari.disabled = true;
        warningBox.innerHTML = '<strong>Info:</strong> Untuk hari Jumat, hanya sesi <strong>Malam</strong> yang tersedia.';
        warningBox.style.display = 'block';
    } else {
        warningBox.style.display = 'none';
    }
}

gedungSelect.addEventListener('change', validateForm);
tanggalInput.addEventListener('change', validateForm);
tanggalInput.addEventListener('input', validateForm);
[waktuSiang, waktuMalam, waktuSehari].forEach(r => r.addEventListener('change', validateForm));

validateForm();
