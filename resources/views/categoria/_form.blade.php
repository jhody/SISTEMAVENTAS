<form id="carro-form" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" id="esNuevo" value="1">
    <input type="hidden" name="id" id="Registro_id" value="{{ old('id', $model->id ?? '') }}">

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group input-group-sm">
                <label for="categoria">NOMBRE <span class="required">*</span></label>
                <input type="text"
                    id="categoria"
                    name="categoria"
                    class="form-control @error('categoria') is-invalid @enderror"
                    maxlength="500"
                    autocomplete="off"
                    placeholder="Ingrese el categoria"
                    value="{{ old('categoria', $model->categoria ?? '') }}">

                @error('categoria')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>





    </div>
</form>
