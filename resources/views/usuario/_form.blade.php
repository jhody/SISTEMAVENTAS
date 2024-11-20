<form id="usuario-form" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" id="esNuevo" value="1">
    <input type="hidden" name="id" id="Registro_id" value="{{ old('id', $model->id ?? '') }}">

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="username">USERNAME <span class="required">*</span></label>
                <input type="text"
                    id="username"
                    name="username"
                    class="form-control @error('username') is-invalid @enderror"
                    maxlength="500"
                    placeholder="Ingrese la username"
                    value="{{ old('username', $model->username ?? '') }}">

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

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
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="nombre">PERFIL <span class="required">*</span></label>
                <select
                    id="perfil"
                    name="perfil"
                    class="form-control ">
                    <option value="administrador">Administrador</option>
                    <option value="vendedor">Vendedor</option>
                </select>
            </div>
        </div>





        <!-- ESTADO -->
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="activo">ESTADO</label>
                <select id="activo" name="activo" class="form-control @error('activo') is-invalid @enderror">
                    <option value="1" {{ old('activo', $model->activo ?? 1) == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('activo', $model->activo ?? 1) == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>

                @error('activo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="password">CLAVE <span class="required">*</span></label>
                <input type="password"
                    id="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    maxlength="100"
                    placeholder="Ingrese el password"
                    value="{{ old('password', $model->password ?? '') }}">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

    </div>
</form>
