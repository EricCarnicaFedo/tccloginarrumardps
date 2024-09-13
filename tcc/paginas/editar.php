<link rel="stylesheet" href="editar.css">
<div id="popupContainer" class="popup-container">
    <div id="popupForm" class="popup-form">
        <span id="closePopup" class="close-btn">&times;</span>

        <h2>Editar Registro</h2>

        <div id="dynamicFields" class="fields-container">
            <!-- Campos da Tabela 3 -->
            <div class="form-group">
                <label for="data">Data</label>
                <input type="text" id="data" name="data" class="custom-input" placeholder="Digite a data">
            </div>

            <div class="form-group">
                <label for="horario">Horário</label>
                <input type="text" id="horario" name="horario" class="custom-input" placeholder="Digite o horário">
            </div>

            <div class="form-group">
                <label for="disponibilidade">Disponibilidade</label>
                <input type="text" id="disponibilidade" name="disponibilidade" class="custom-input"
                    placeholder="Digite a disponibilidade">
            </div>

            <div class="form-group">
                <label for="acoes">Ações</label>
                <input type="text" id="acoes" name="acoes" class="custom-input" placeholder="Digite as ações">
            </div>
        </div>

        <!-- Botão de Salvar -->
        <div class="form-actions">
            <button id="saveBtn" class="save-btn">Salvar</button>
        </div>
    </div>
</div>

<script>
    // Mostrar o popup
    document.getElementById('openPopup').addEventListener('click', function () {
        document.getElementById('popupContainer').style.display = 'flex';
    });

    // Fechar o popup
    document.getElementById('closePopup').addEventListener('click', function () {
        document.getElementById('popupContainer').style.display = 'none';
    });

</script>