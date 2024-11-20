<form id="producto-form" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="hidden" id="esNuevo" value="1">
    <input type="hidden" name="id" id="Registro_id" value="{{ old('id', $producto->id ?? '') }}">

    <div class="row">
        <!-- Nombre -->
        <div class="col-sm-12">
            <div class="form-group input-group-sm">
                <label for="nombre">Nombre <span class="required">*</span></label>
                <input type="text"
                    id="nombre"
                    name="nombre"
                    class="form-control @error('nombre') is-invalid @enderror"
                    maxlength="500"
                    placeholder="Ingrese el nombre del producto"
                    value="{{ old('nombre', $producto->nombre ?? '') }}">

                @error('nombre')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="codigo">Código <span class="required">*</span></label>
                <input type="text"
                    id="codigo"
                    name="codigo"
                    class="form-control @error('codigo') is-invalid @enderror"
                    maxlength="45"
                    placeholder="Ingrese el codigo del producto"
                    value="{{ old('codigo', $producto->codigo ?? '') }}">

                @error('codigo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="id_categoria">Categoría <span class="required">*</span></label>
                <select id="id_categoria" name="id_categoria" class="form-control @error('id_categoria') is-invalid @enderror">
                    <option value="">Seleccione una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}"
                            {{ old('id_categoria', $producto->id_categoria ?? '') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->categoria }}
                        </option>
                    @endforeach
                </select>

                @error('id_categoria')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="stock">Stock <span class="required">*</span></label>
                <input type="number"
                    id="stock"
                    name="stock"
                    class="form-control @error('stock') is-invalid @enderror"
                    step="0.01"
                    placeholder="Ingrese el stock del producto"
                    value="{{ old('stock', $producto->stock ?? '') }}">

                @error('stock')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <!-- Unidad de Medida -->
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="idunidad_medida">Unidad de Medida <span class="required">*</span></label>
                <select id="idunidad_medida" name="idunidad_medida" class="form-control @error('idunidad_medida') is-invalid @enderror">
                    <option value="">Seleccione una unidad de medida</option>
                    @foreach ($unidades as $unidad)
                        <option value="{{ $unidad->id }}"
                            {{ old('idunidad_medida', $producto->idunidad_medida ?? '') == $unidad->id ? 'selected' : '' }}>
                            {{ $unidad->nombre }}
                        </option>
                    @endforeach
                </select>

                @error('idunidad_medida')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>



        <!-- Precio -->
        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="precio_venta">Precio Venta<span class="required">*</span></label>
                <input type="number"
                    id="precio_venta"
                    name="precio_venta"
                    class="form-control @error('precio_venta') is-invalid @enderror"
                    step="0.01"
                    placeholder="Ingrese el precio de venta del producto"
                    value="{{ old('precio_venta', $producto->precio_venta ?? '') }}">

                @error('precio_venta')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group input-group-sm">
                <label for="precio_compra">Precio Compra<span class="required">*</span></label>
                <input type="number"
                    id="precio_compra"
                    name="precio_compra"
                    class="form-control @error('precio_compra') is-invalid @enderror"
                    step="0.01"
                    placeholder="Ingrese el precio de compra del producto"
                    value="{{ old('precio_compra', $producto->precio_compra ?? '') }}">

                @error('precio_compra')
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
                    <option value="1" {{ old('estado', $producto->estado ?? 1) == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('estado', $producto->estado ?? 1) == 0 ? 'selected' : '' }}>Inactivo</option>
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
