const wheel = document.getElementById("wheel");
const spinBtn = document.getElementById("spin");
const turnLeftDisplay = document.querySelector('.text-white');

// Ambil nilai dari server (via PHP)
const noAgen = "<?= session()->get('noAgen') ?>";
console.log(noAgen);

// Ambil nilai awal turnLeft dan totalSpin
let turnLeft = parseInt(turnLeftDisplay.textContent.replace("Sisa Spin: ", ""));
let totalSpin = parseInt(document.getElementById("totalSpin").textContent);

// Validasi nilai
if (isNaN(turnLeft)) {
  console.error("turnLeft tidak valid");
  turnLeft = 0;
}
if (isNaN(totalSpin)) {
  console.error("totalSpin tidak valid");
  totalSpin = 0;
}

let spinning = false;
let currentRotation = 0;
let highlightedSegment = null;
const maxSpin = 1; // Spin normal maksimal

const segmentsData = [
  { value: "0", text: "0" },
  { value: "1.000", text: "1.000" },
  { value: "10.000", text: "10.000" },
  { value: "100.000", text: "100.000" },
  { value: "0", text: "0" },
  { value: "1.000", text: "1.000" },
  { value: "10.000", text: "10.000" },
  { value: "200.000", text: "200.000" },
];

// Buat segmen roda
segmentsData.forEach((segment, index) => {
  const div = document.createElement("div");
  div.setAttribute("value", segment.value);
  div.textContent = segment.text;

  const angle = (360 / segmentsData.length) * index;
  div.style.transform = `rotate(${angle}deg)`;
  div.classList.add("segment");
  div.style.backgroundColor = index % 2 === 0 ? "#8A2D3B" : "#641B2E";

  wheel.appendChild(div);
});

// Fungsi untuk update data ke server
function updateTurnLeftAndTotalSpin(turnLeft, totalSpin) {
  fetch('/home/updateTurnLeftAndTotalSpin', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ turnLeft, totalSpin }) // Tidak kirim noAgen
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === 'success') {
      turnLeftDisplay.textContent = `Sisa Spin: ${data.turnLeft}`;
    } else {
      alert("Gagal update database: " + data.message);
    }
  })
  .catch(error => {
    console.error("Fetch error:", error);
    alert("Terjadi kesalahan saat menghubungi server.");
  });
}

// Event klik SPIN
spinBtn.addEventListener("click", () => {
  if (spinning) return;

  // Cek apakah spin masih tersedia
  if (turnLeft <= 0) {
    alert("❗𝐈𝐌𝐏𝐎𝐑𝐓𝐀𝐍𝐓❗ Spin kamu sudah habis.");
    return;
  }

  spinning = true;
  document.querySelectorAll('.segment').forEach(seg => seg.classList.remove("highlight"));

  const totalSegments = segmentsData.length;
  const segmentAngle = 360 / totalSegments;

  let randomIndex;

  // Jika sudah lebih dari maxSpin, paksa hasil ke "0"
  if (totalSpin >= maxSpin) {
  // Setelah 2 spin: selalu dapat 0
  const zeroIndices = segmentsData
    .map((seg, i) => seg.value === "0" ? i : -1)
    .filter(i => i !== -1);
  randomIndex = zeroIndices[Math.floor(Math.random() * zeroIndices.length)];
} else {
  // Spin pertama dan kedua: hindari hasil 0
  const nonZeroIndices = segmentsData
    .map((seg, i) => seg.value !== "0" ? i : -1)
    .filter(i => i !== -1);
  randomIndex = nonZeroIndices[Math.floor(Math.random() * nonZeroIndices.length)];
}

  const angleOffset = segmentAngle / 2;
  const targetAngle = randomIndex * segmentAngle + angleOffset;
  const extraRotation = 360 * 5;
  const finalRotation = extraRotation + (360 - (targetAngle % 360));

  wheel.style.transition = "transform 5s ease-out";
  wheel.style.transform = `rotate(${currentRotation + finalRotation}deg)`;
  currentRotation += finalRotation;

  setTimeout(() => {
    const selectedSegment = document.querySelectorAll('.segment')[randomIndex];
    selectedSegment.classList.add("highlight");
    alert(`🎉 Selamat! Kamu mendapatkan hadiah: ${segmentsData[randomIndex].value}`);
  }, 4800);

  setTimeout(() => {
    turnLeft--;
    totalSpin++;

    // Update tampilan dan server
    turnLeftDisplay.textContent = `Sisa Spin: ${turnLeft}`;
    updateTurnLeftAndTotalSpin(turnLeft, totalSpin);

    spinning = false;
  }, 5500);
});
