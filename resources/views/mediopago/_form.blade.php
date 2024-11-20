<form id="carro-form" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" id="esNuevo" value="1">
    <input type="hidden" name="id" id="Registro_id" value="{{ old('id', $model->id ?? '') }}">

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="nombre">NOMBRE <span class="required">*</span></label>
                <input type="text"
                    id="nombre"
                    name="nombre"
                    class="form-control @error('nombre') is-invalid @enderror"
                    maxlength="500"
                    placeholder="Ingrese la nombre"
                    value="{{ old('nombre', $model->nombre ?? '') }}">

                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>





        <!-- ESTADO -->
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="estado">ESTADO</label>
                <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror">
                    <option value="1" {{ old('estado', $model->estado ?? 1) == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado', $model->estado ?? 1) == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>

                @error('estado')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
</form>
