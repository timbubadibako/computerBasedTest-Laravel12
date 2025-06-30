import './bootstrap';

//Admin.dashboard (Buat Quiz - Preview)
document.getElementById('csv').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(event) {
        const lines = event.target.result.split('\n');
        const container = document.getElementById('preview-container');
        container.innerHTML = ''; // Kosongkan preview sebelumnya

        lines.forEach((line, index) => {
            if (line.trim() === '' || index === 0) return; // skip header/empty
            const columns = line.split(',');
            const pertanyaan = columns[1]?.replace(/"/g, '') || 'Pertanyaan tidak terbaca';
            const opsiA = columns[2]?.replace(/"/g, '');
            const opsiB = columns[3]?.replace(/"/g, '');
            const opsiC = columns[4]?.replace(/"/g, '');
            const opsiD = columns[5]?.replace(/"/g, '');
            const jawaban = columns[6]?.trim();

            const soalHTML = `
                <div class="bg-white p-3 rounded shadow-sm border">
                    <div class="font-semibold text-gray-700 mb-1">${index}. ${pertanyaan}</div>
                    <ul class="pl-4 text-gray-600 list-disc">
                        <li>A. ${opsiA}</li>
                        <li>B. ${opsiB}</li>
                        <li>C. ${opsiC}</li>
                        <li>D. ${opsiD}</li>
                    </ul>
                    <div class="mt-1 text-sm text-green-600">Jawaban: ${jawaban}</div>
                </div>`;
            container.innerHTML += soalHTML;
        });
    };
    reader.readAsText(file);
});

//Admin.dashboard (Modifier URL)
window.addEventListener('DOMContentLoaded', () => {
    const hash = window.location.hash.replace('#', '');
    if (hash) {
        const tabToOpen = document.querySelector(`[data-tab="${hash}"]`);
        if (tabToOpen) tabToOpen.click();
    }
});

//Admin.dashboard (Buat Quiz - Generate Token)

function generateToken() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let token = '';
        for (let i = 0; i < 6; i++) {
            token += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        document.getElementById('token').value = token;
    }

document.addEventListener('DOMContentLoaded', function () {
    const totalQuestions = parseInt(document.getElementById('quiz-data').dataset.total);
    let currentQuestionIndex = 0;

    const questionNav = document.getElementById('questionNav');
    const answeredCountEl = document.getElementById('answeredCountEl');
    const quizProgress = document.getElementById('quizProgress');

    // Buat tombol navigasi soal secara dinamis
    for (let i = 0; i < totalQuestions; i++) {
        const btn = document.createElement('button');
        btn.textContent = i + 1;
        btn.className = 'w-8 h-8 text-sm border border-gray-300 rounded hover:bg-gray-50 transition-colors';
        btn.onclick = () => goToQuestion(i);
        questionNav.appendChild(btn);
    }

    function showQuestion(idx) {
        document.querySelectorAll('.question-block').forEach((el, i) => {
            el.classList.toggle('hidden', i !== idx);
        });

        // Optional: kalau ingin tampilkan counter soal
        document.getElementById('questionCounterDisplay').textContent = `Soal ${idx + 1} dari ${totalQuestions}`;

        document.getElementById('prevBtn').disabled = idx === 0;
        document.getElementById('nextBtn').classList.toggle('hidden', idx === totalQuestions - 1);
        document.getElementById('submitBtn').classList.toggle('hidden', idx !== totalQuestions - 1);

        updateNav(idx);
        updateProgress();
    }

    function goToQuestion(idx) {
        currentQuestionIndex = idx;
        showQuestion(idx);
    }

    function updateNav(idx) {
        document.querySelectorAll('#questionNav button').forEach((btn, i) => {
            btn.className = 'w-8 h-8 text-sm border border-gray-300 rounded hover:bg-gray-50 transition-colors';

            const isAnswered = document.querySelector(`.question-block[data-index="${i}"] input[type="radio"]:checked`);
            if (isAnswered) {
                btn.classList.add('bg-green-100', 'border-green-300', 'text-green-700');
            }

            if (i === idx) {
                btn.classList.add('bg-blue-600', 'text-white');
            }
        });
    }

    function updateProgress() {
        const answered = document.querySelectorAll('input[type="radio"]:checked').length;
        answeredCountEl.textContent = answered;
        quizProgress.style.width = (answered / totalQuestions * 100) + '%';
    }

    // Navigasi soal
    document.getElementById('prevBtn').onclick = () => {
        if (currentQuestionIndex > 0) {
            currentQuestionIndex--;
            showQuestion(currentQuestionIndex);
        }
    };

    document.getElementById('nextBtn').onclick = () => {
        if (currentQuestionIndex < totalQuestions - 1) {
            currentQuestionIndex++;
            showQuestion(currentQuestionIndex);
        }
    };

    // Deteksi perubahan jawaban
    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.addEventListener('change', () => {
            updateProgress();
            updateNav(currentQuestionIndex);
        });
    });

    // Inisialisasi tampilan soal pertama
    showQuestion(currentQuestionIndex);






});

