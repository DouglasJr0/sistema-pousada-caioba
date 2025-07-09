<div class="form-group">
    <label for="numero">Número do Quarto</label>
    <input type="text" name="numero" class="form-control" value="{{ old('numero', $quarto->numero ?? '') }}" required>
</div>

<div class="form-group">
    <label for="tipo">Tipo</label>
    <input type="text" name="tipo" class="form-control" value="{{ old('tipo', $quarto->tipo ?? '') }}" required>
</div>

<div class="form-group">
    <label for="capacidade">Capacidade</label>
    <input type="number" name="capacidade" class="form-control" value="{{ old('capacidade', $quarto->capacidade ?? '') }}" required>
</div>

<div class="form-group">
    <label for="valor_diaria">Valor da Diária</label>
    <input type="number" step="0.01" name="valor_diaria" class="form-control" value="{{ old('valor_diaria', $quarto->valor_diaria ?? '') }}" required>
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select name="status" class="form-control" required>
        <option value="disponível" {{ (old('status', $quarto->status ?? '') == 'disponível') ? 'selected' : '' }}>Disponível</option>
        <option value="reservado" {{ (old('status', $quarto->status ?? '') == 'reservado') ? 'selected' : '' }}>Reservado</option>
        <option value="manutenção" {{ (old('status', $quarto->status ?? '') == 'manutenção') ? 'selected' : '' }}>Manutenção</option>
    </select>
</div>
