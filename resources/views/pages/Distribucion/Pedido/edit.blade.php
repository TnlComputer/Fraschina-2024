@extends('adminlte::page')

@section('title', 'Editar Pedido')

@section('content')
<div class="container">
  <h1>Editar Pedido</h1>

  <div class="card">
    <div class="card-header bg-primary text-white">
      Información del Pedido
    </div>
    <div class="card-body">
      <form action="{{ route('distribucion_pedido.update', $pedido->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <label for="fechaEntrega" class="form-label">Fecha de Entrega</label>
          <input type="date" id="fechaEntrega" name="fechaEntrega" class="form-control"
            value="{{ $pedido->fechaEntrega }}" required>
        </div>

        <div class="mb-3">
          <label for="cliente" class="form-label">Cliente</label>
          <input type="text" id="cliente" name="cliente" class="form-control"
            value="{{ $pedido->distribucion->nomfantasia }}" readonly>
        </div>

        <div class="mb-3">
          <label for="estado" class="form-label">Estado</label>
          <select id="estado" name="estado" class="form-control">
            <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="completado" {{ $pedido->estado == 'completado' ? 'selected' : '' }}>Completado</option>
          </select>
        </div>

        <h4>Detalles de los productos</h4>
        <table class="table table-sm table-striped table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>Producto</th>
              <th class="text-center">Cantidad</th>
              <th class="text-center">Precio Unitario</th>
              <th class="text-center">Subtotal</th>
              <th class="text-center">Total Item</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pedido->lineasPedidos as $detalle)
            <tr class="linea-row">
              <td>
                <select name="lineas[{{ $detalle->id }}][producto_id]" class="form-control producto">
                  @foreach ($productos as $producto)
                  <option value="{{ $producto->producto_id }}" data-iva="{{ $producto->producto->ivacda }}" {{
                    $producto->producto_id ==
                    $detalle->producto_id ? 'selected' : '' }}>
                    {{ $producto->producto->productoCDA }}
                  </option> @endforeach
                </select>
              </td>
              <td class="text-center">
                <input type="number" name="lineas[{{ $detalle->id }}][cantidad]" value="{{ $detalle->cantidad }}"
                  class="form-control cantidad" required>
              </td>
              <td class="text-center">
                <input type="number" step="0.01" name="lineas[{{ $detalle->id }}][precio_unitario]"
                  value="{{ $detalle->precio_unitario }}" class="form-control precio" required>
              </td>
              <td class="text-center">
                <span class="subtotal">0.00</span>
              </td>
              <td class="text-center">
                <span class="total-iva">0.00</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

        <div class="mt-3">
          <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar Cambios</button>
          <a href="{{ route('distribucion_reparto.index', ['fecha' => $pedido->fechaEntrega]) }}"
            class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Volver
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
  // Selecciona todas las filas de línea de pedido
  const filas = document.querySelectorAll('.linea-row');

  filas.forEach(function(fila) {
    const cantidadInput = fila.querySelector('.cantidad');
    const precioInput = fila.querySelector('.precio');
    const productoSelect = fila.querySelector('.producto');
    const subtotalField = fila.querySelector('.subtotal');
    const totalIvaField = fila.querySelector('.total-iva');

    // Función para obtener el IVA del producto seleccionado
    function getIva() {
      const selectedOption = productoSelect.options[productoSelect.selectedIndex];
      const iva = parseFloat(selectedOption.dataset.iva) || 0;
      return iva;
    }

    // Función para actualizar subtotal y total con IVA
    function actualizarTotales() {
      const cantidad = parseFloat(cantidadInput.value) || 0;
      const precio = parseFloat(precioInput.value) || 0;
      const subtotal = cantidad * precio;
      const iva = getIva();
      // Total con IVA = subtotal * (1 + (iva/100))
      const totalConIva = subtotal * (1 + iva / 100);
      subtotalField.textContent = subtotal.toFixed(2);
      totalIvaField.textContent = totalConIva.toFixed(2);
    }

    // Escuchar cambios en cantidad, precio y el select de producto
    cantidadInput.addEventListener('input', actualizarTotales);
    precioInput.addEventListener('input', actualizarTotales);
    productoSelect.addEventListener('change', actualizarTotales);

    // Actualiza los totales al cargar la página
    actualizarTotales();
  });
});
</script>
@endsection