<?php
$page_title = 'Tambah Quiz';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2>Tambah Quiz untuk: <?php echo htmlspecialchars($modul['judul']); ?></h2>
    <form method="POST" action="index.php?action=quiz_create&modul_id=<?php echo $modul['id']; ?>" id="quizForm">
        <input type="hidden" name="modul_id" value="<?php echo $modul['id']; ?>">
        
        <div class="form-group">
            <label for="pertanyaan">Pertanyaan</label>
            <textarea id="pertanyaan" name="pertanyaan" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="tipe">Tipe Quiz</label>
            <select id="tipe" name="tipe" required onchange="togglePilihan()">
                <option value="pilihan_ganda">Pilihan Ganda</option>
                <option value="essay">Essay</option>
            </select>
        </div>
        
        <div id="pilihanContainer">
            <h3>Pilihan Jawaban</h3>
            <div id="pilihanList">
                <div class="form-group">
                    <input type="text" name="pilihan[]" placeholder="Pilihan A" required>
                    <input type="radio" name="correct_answer" value="0" required> Benar
                </div>
                <div class="form-group">
                    <input type="text" name="pilihan[]" placeholder="Pilihan B" required>
                    <input type="radio" name="correct_answer" value="1"> Benar
                </div>
                <div class="form-group">
                    <input type="text" name="pilihan[]" placeholder="Pilihan C" required>
                    <input type="radio" name="correct_answer" value="2"> Benar
                </div>
                <div class="form-group">
                    <input type="text" name="pilihan[]" placeholder="Pilihan D" required>
                    <input type="radio" name="correct_answer" value="3"> Benar
                </div>
            </div>
        </div>
        
        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php?action=quiz_index&modul_id=<?php echo $modul['id']; ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script>
function togglePilihan() {
    const tipe = document.getElementById('tipe').value;
    const container = document.getElementById('pilihanContainer');
    if (tipe === 'essay') {
        container.style.display = 'none';
        document.querySelectorAll('#pilihanList input[type="text"]').forEach(input => {
            input.removeAttribute('required');
        });
        document.querySelectorAll('#pilihanList input[type="radio"]').forEach(radio => {
            radio.removeAttribute('required');
        });
    } else {
        container.style.display = 'block';
        document.querySelectorAll('#pilihanList input[type="text"]').forEach(input => {
            input.setAttribute('required', 'required');
        });
        document.querySelectorAll('#pilihanList input[type="radio"]').forEach(radio => {
            radio.setAttribute('required', 'required');
        });
    }
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

