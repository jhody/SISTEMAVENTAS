<form id="cliente-form" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" id="esNuevo" value="1">
    <input type="hidden" name="id" id="Registro_id" value="{{ old('id', $cliente->id ?? '') }}">

    <div class="row">
        <!-- Nombre -->
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="razonsocial">Razón social <span class="required">*</span></label>
                <input type="text"
                    id="razonsocial"
                    name="razonsocial"
                    class="form-control @error('razonsocial') is-invalid @enderror"
                    maxlength="500"
                    placeholder="Ingrese el razonsocial del cliente"
                    value="{{ old('razonsocial', $cliente->razonsocial ?? '') }}">

                @error('razonsocial')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="ruc">RUC <span class="required">*</span></label>
                <input type="text"
                    id="ruc"
                    name="ruc"
                    class="form-control @error('ruc') is-invalid @enderror"
                    maxlength="500"
                    placeholder="Ingrese el ruc del cliente"
                    value="{{ old('ruc', $cliente->ruc ?? '') }}">

                @error('ruc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Dirección -->
        <div class="col-sm-12">
            <div class="form-group input-group-sm">
                <label for="domicilio">Domicilio Fiscal</label>
                <input type="text"
                    id="domicilio"
                    name="domicilio"
                    class="form-control @error('domicilio') is-invalid @enderror"
                    maxlength="500"
                    placeholder="Ingrese el domicilio del cliente"
                    value="{{ old('domicilio', $cliente->domicilio ?? '') }}">

                @error('domicilio')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="persona">Persona de contacto </label>
                <input type="text"
                    id="persona"
                    name="persona"
                    class="form-control @error('persona') is-invalid @enderror"
                    maxlength="500"
                    placeholder="Ingrese el persona del cliente"
                    value="{{ old('persona', $cliente->persona ?? '') }}">

                @error('persona')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="contacto">Contacto </label>
                <input type="text"
                    id="contacto"
                    name="contacto"
                    class="form-control @error('contacto') is-invalid @enderror"
                    maxlength="500"
                    placeholder="Ingrese el contacto del cliente"
                    value="{{ old('contacto', $cliente->contacto ?? '') }}">

                @error('contacto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- Correo -->
        <div class="col-sm-12">
            <div class="form-group input-group-sm">
                <label for="correo">Correo</label>
                <input type="email"
                    id="correo"
                    name="correo"
                    class="form-control @error('correo') is-invalid @enderror"
                    maxlength="500"
                    placeholder="Ingrese el correo del cliente"
                    value="{{ old('correo', $cliente->correo ?? '') }}">

                @error('correo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>



        <!-- Estado -->
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="estado">Estado</label>
                <select id="estado" name="estado" class="form-control @error('estado') is-invalid @enderror">
                    <option value="1" {{ old('estado', $cliente->estado ?? 1) == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado', $cliente->estado ?? 1) == 0 ? 'selected' : '' }}>Inactivo</option>
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
