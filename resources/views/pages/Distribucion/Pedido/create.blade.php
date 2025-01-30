@extends('adminlte::page')

@section('title', 'Crear Pedido')

@section('content_header')
<h1>Nuevo Pedido</h1>
@endsection

@section('content')
<form id="pedido-form" action="{{ route('distribucion_pedido.store') }}" method="POST">
  @csrf

  <!-- Cliente -->
  <div class="form-group">
    <label for="cliente_id">Cliente:</label>
    <select name="cliente_id" id="cliente_id" class="form-control" required>
      <option value="">Seleccione un cliente</option>
      @foreach($clientes as $cliente)
      <option value="{{ $cliente->id }}">{{ $cliente->nomfantasia }} - {{ $cliente->razonsocial }}</option>
      @endforeach
    </select>
  </div>

  <!-- Fechas -->
  <div class="row">
    <div class="col-md-6">
      <label for="fecha_pedido">Fecha del Pedido:</label>
      <input type="date" id="fecha_pedido" class="form-control" value="{{ date('Y-m-d') }}" readonly>
    </div>
    <div class="col-md-6">
      <label for="fecha_entrega">Fecha de Entrega:</label>
      <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control" required>
    </div>
  </div>

  <!-- Agregar Producto/Tarea -->
  <h4 class="mt-3">Agregar Producto o Tarea</h4>
  <div class="row">
    <div class="col-md-2">
      <label for="tipo">Tipo:</label>
      <select id="tipo" class="form-control">
        <option value="P">Producto</option>
        <option value="T">Tarea</option>
      </select>
    </div>
    <div class="col-md-4">
      <label for="producto_id">Producto/Tarea:</label>
      <select id="producto_id" class="form-control">
        <option value="">Seleccione</option>
      </select>
    </div>
    <div class="col-md-3">
      <label for="cantidad">Cantidad:</label>
      <input type="number" id="cantidad" class="form-control" placeholder="Cantidad">
    </div>
    <div class="col-md-3 d-flex align-items-end">
      <button type="button" id="add-item" class="btn btn-success">Agregar</button>
    </div>
  </div>

  <!-- Tabla de Productos/Tareas Agregados -->
  <h4 class="mt-3">Detalles del Pedido</h4>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Tipo</th>
        <th>Descripción</th>
        <th>Cantidad</th>
        <th>Acción</th>
      </tr>
    </thead>
    <tbody id="pedido-detalle">
      <!-- Se cargarán aquí los productos/tareas agregados -->
    </tbody>
  </table>

  <!-- Campo de Observaciones -->
  <div class="form-group">
    <label for="observaciones">Observaciones:</label>
    <textarea name="observaciones" id="observaciones" class="form-control" rows="3"></textarea>
  </div>

  <button type="submit" class="btn btn-primary">Guardar Pedido</button>
</form>

<script>
  let productosDisponibles = [];
  let tareasDisponibles = [];

  // Cargar productos y tareas cuando se selecciona el cliente
  document.getElementById('cliente_id').addEventListener('change', async function() {
    let clienteId = this.value;
    if (!clienteId) return;

    try {
      // Cargar productos y tareas del cliente
      let response = await fetch(`/productos-y-tareas-por-cliente/${clienteId}`);
      let data = await response.json();
      
      productosDisponibles = data.productos;
      tareasDisponibles = data.tareas;

      actualizarSelectProductos();
    } catch (error) {
      console.error('Error cargando productos/tareas:', error);
    }
  });

  // Cambiar opciones del select según tipo (Producto o Tarea)
  document.getElementById('tipo').addEventListener('change', function() {
    let tipo = this.value;

    // Mostrar o ocultar el campo de cantidad
    if (tipo === 'T') {
      document.getElementById('cantidad').style.display = 'none';  // Ocultar cantidad para tareas
    } else {
      document.getElementById('cantidad').style.display = 'block'; // Mostrar cantidad para productos
    }

    actualizarSelectProductos();
  });

  function actualizarSelectProductos() {
    let tipo = document.getElementById('tipo').value;
    let select = document.getElementById('producto_id');
    select.innerHTML = '<option value="">Seleccione</option>';

    if (tipo === 'P') {
      // Mostrar productos
      productosDisponibles.forEach(p => {
        select.innerHTML += `<option value="${p.id}">${p.nombre}</option>`;
      });
    } else if (tipo === 'T') {
      // Mostrar tareas
      tareasDisponibles.forEach(t => {
        select.innerHTML += `<option value="${t.id}">${t.tarea}</option>`;
      });
    }
  }

  // Agregar producto o tarea a la tabla
  // document.getElementById('add-item').addEventListener('click', function () {
  //   let tipo = document.getElementById('tipo').value;
  //   let productoSelect = document.getElementById('producto_id');
  //   let productoId = productoSelect.value;
  //   let productoNombre = productoSelect.options[productoSelect.selectedIndex].text;
  //   let cantidad = document.getElementById('cantidad').value;

  //   if (!productoId) {
  //     alert("Seleccione un producto/tarea.");
  //     return;
  //   }

  //   if (tipo === 'P' && !cantidad) {
  //     alert("Especifique la cantidad para el producto.");
  //     return;
  //   }

  //   let tableBody = document.getElementById('pedido-detalle');
  //   let newRow = document.createElement('tr');

  //   newRow.innerHTML = `
  //     <td>${tipo === 'P' ? 'Producto' : 'Tarea'}</td>
  //     <td>${productoNombre} <input type="hidden" name="productos[]" value="${productoId}"></td>
  //     <td>${tipo === 'P' ? cantidad : ''} <input type="hidden" name="cantidades[]" value="${tipo === 'P' ? cantidad : ''}"></td>
  //     <td><button type="button" class="btn btn-danger remove-item">X</button></td>
  //   `;

  //   tableBody.appendChild(newRow);
  //   document.getElementById('cantidad').value = ""; // Limpiar cantidad
  // });

  document.getElementById('add-item').addEventListener('click', function () {
  let tipo = document.getElementById('tipo').value;
  let productoSelect = document.getElementById('producto_id');
  let productoId = productoSelect.value;
  let productoNombre = productoSelect.options[productoSelect.selectedIndex].text;
  let cantidad = document.getElementById('cantidad').value;
  
  if (!productoId) {
  alert("Seleccione un producto/tarea.");
  return;
  }
  
  if (tipo === 'P' && !cantidad) {
  alert("Especifique la cantidad para el producto.");
  return;
  }
  
  let tableBody = document.getElementById('pedido-detalle');
  let newRow = document.createElement('tr');
  
  // Si el tipo es 'Producto', se agregan campos de producto y cantidad.
  // Si es 'Tarea', solo se agrega la tarea.
  newRow.innerHTML = `
  <td>${tipo === 'P' ? 'Producto' : 'Tarea'}</td>
  <td>${productoNombre} <input type="hidden" name="tipos[]" value="${tipo}"><input type="hidden" name="productos[]"
      value="${productoId}"></td>
  <td>${tipo === 'P' ? cantidad : ''} <input type="hidden" name="cantidades[]" value="${tipo === 'P' ? cantidad : ''}">
  </td>
  <td><button type="button" class="btn btn-danger remove-item">X</button></td>
  `;
  
  tableBody.appendChild(newRow);
  document.getElementById('cantidad').value = ""; // Limpiar cantidad
  });

  
  // Eliminar ítem de la tabla
  document.addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-item')) {
      event.target.closest('tr').remove();
    }
  });

  // Establecer fecha mínima de entrega como la fecha actual
  document.getElementById('fecha_entrega').setAttribute('min', new Date().toISOString().split('T')[0]);
</script>
@endsection