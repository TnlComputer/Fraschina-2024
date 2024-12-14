INSERT INTO fraschina_2024.distribucion_agenda (
    id,                -- ID principal
    fecha_ant,         -- Fecha anterior
    fecha,             -- Fecha CDAgenda
    hs,                -- Hora
    prioridad_id,      -- Relación con prioridad
    prioridad,         -- Prioridad
    accion_id,         -- Relación con acción
    accion,            -- Acción
    temas,             -- Temas
    cotizacion,        -- Cotización
    fecCotEnt,         -- Fecha de cotización entrada
    fecCot,            -- Fecha de cotización
    producto_id,       -- Relación con producto
    productos,         -- Producto
    desde,             -- Hora desde
    hasta,             -- Hora hasta
    lunes,             -- Lunes
    sabado,            -- Sábado
    fac_imp,           -- Facturación
    obs,               -- Observaciones
    distribucion_id,   -- ID de distribución
    razonsocial,       -- Razón social
    nombrefantasia,    -- Nombre de fantasía
    persona_id,        -- ID de la persona
    nombre_per,        -- Nombre de la persona
    apellido_per,      -- Apellido de la persona
    tipoper_id,        -- Relación con tipo de persona
    tipopersona,       -- Tipo de persona
    veraz_id,          -- Relación con veraz
    veraz,             -- Veraz
    estado_id,         -- Relación con estado
    estado,            -- Estado
    contacto_id,       -- ID de contacto inicial
    contacto_inicial,  -- Contacto inicial
    cargo_id,          -- Relación con cargo
    cargo,             -- Cargo
    info,              -- Información adicional
    calle_id,          -- ID de la calle
    calle,             -- Calle
    altura,            -- Altura
    dpto,              -- Departamento
    piso,              -- Piso
    barrio_id,         -- Relación con barrio
    barrio,            -- Barrio
    municipio_id,      -- Relación con municipio
    municipio,         -- Municipio
    localidad_id,      -- Relación con localidad
    localidad,         -- Localidad
    zona_id,           -- Relación con zona
    zona,              -- Zona
    rubro_id,          -- Relación con rubro
    rubro,             -- Rubro
    tamanio_id,        -- Relación con tamaño
    tamanio,           -- Tamaño
    modo_id,           -- Relación con modo
    modo,              -- Modo
    telefono,          -- Teléfono
    desde1,            -- Hora desde 1
    hasta2,            -- Hora hasta 2
    auto,              -- Auto
    pedido_id,         -- ID de pedido
    obsEntrega,        -- Observaciones de entrega
    chofer,            -- Chofer
    orden,             -- Orden
    pago,              -- Pago
    tpago,             -- Tipo de pago
    cobrar,            -- Cobrar
    estadoPedido,      -- Estado del pedido
    status,            -- Estado del registro
    created_at,        -- Fecha de creación
    updated_at         -- Fecha de actualización
)
SELECT
    id_CDAg AS id,                          -- ID de CDAgenda
    fechaAnt AS fecha_ant,                  -- Fecha anterior
    fecha_CDAg AS fecha,                    -- Fecha CDAgenda
    hora_CDAg AS hs,                        -- Hora CDAgenda
    idPrio AS prioridad_id,                 -- Relación con prioridad
    prio_CDAg AS prioridad,                 -- Prioridad
    idAccion AS accion_id,                  -- Relación con acción
    accion_CDAg AS accion,                  -- Acción
    temas_CDAg AS temas,                    -- Temas
    cotiz_CDAg AS cotizacion,               -- Cotización
    fecCotEnt_CDAg AS fecCotEnt,            -- Fecha de cotización entrada
    fecCot_CDAg AS fecCot,                  -- Fecha de cotización
    NULLIF(idProductoCDA, '') AS producto_id, -- Relación con producto (handle empty string)
    produc_CDAg AS productos,               -- Producto (corrected column name)
    desde_CDAg AS desde,                    -- Hora desde
    hasta_CDAg AS hasta,                    -- Hora hasta
    lunes_CDAg AS lunes,                    -- Lunes
    sabado_CDAg AS sabado,                  -- Sábado
    fac_imp_CDAg AS fac_imp,                -- Facturación
    obs_CDAg AS obs,                        -- Observaciones
    Idcliente AS distribucion_id,           -- ID de distribución
    rs_CDAg AS razonsocial,                 -- Razón social
    fantasia_CDAg AS nombrefantasia,        -- Nombre de fantasía
    NULLIF(id_persCD, '') AS persona_id,    -- Handle empty string for persona_id
    nom_pers_CDAg AS nombre_per,            -- Nombre de la persona
    ape_pers_CDAg AS apellido_per,          -- Apellido de la persona
    id_tipoper AS tipoper_id,               -- Relación con tipo de persona
    tipo_per_CDAg AS tipopersona,           -- Tipo de persona
    idVeraz AS veraz_id,                    -- Relación con veraz
    veraz_CDAg AS veraz,                    -- Veraz
    idEstado AS estado_id,                  -- Relación con estado
    estado_CDAg AS estado,                  -- Estado
    idContInit AS contacto_id,              -- ID de contacto inicial
    contacto_ini_CDAg AS contacto_inicial,  -- Contacto inicial
    NULLIF(idCargo, '') AS cargo_id,        -- Handle empty string for cargo_id
    cargo_CDAg AS cargo,                    -- Cargo
    informacion_CDAg AS info,               -- Información adicional
    idCalle AS calle_id,                    -- ID de la calle
    calle_CDAg AS calle,                    -- Calle
    altura_CDAg AS altura,                  -- Altura
    dpto_CDAg AS dpto,                      -- Departamento
    piso_CDAg AS piso,                      -- Piso
    idBarrio AS barrio_id,                  -- Relación con barrio
    barrio_CDAg AS barrio,                  -- Barrio
    idCiudad AS municipio_id,               -- Relación con municipio
    ciudad_CDAg AS municipio,               -- Municipio
    idLocalidad AS localidad_id,            -- Relación con localidad
    localidad_CDAg AS localidad,            -- Localidad
    idZona AS zona_id,                      -- Relación con zona
    zona_CDAg AS zona,                      -- Zona
    idRubro AS rubro_id,                    -- Relación con rubro
    rubro_CDAg AS rubro,                    -- Rubro
    idTamano AS tamanio_id,                 -- Relación con tamaño
    tamano_CDAg AS tamanio,                 -- Tamaño
    idModo AS modo_id,                      -- Relación con modo
    modo_CDAg AS modo,                      -- Modo
    tel_CDAg AS telefono,                   -- Teléfono
    desde_CDAg1 AS desde1,                  -- Hora desde 1
    hasta_CDAg1 AS hasta2,                  -- Hora hasta 2
    auto_CDAg AS auto,                      -- Auto
    pedidosID AS pedido_id,                 -- ID de pedido
    obsEntrega AS obsEntrega,               -- Observaciones de entrega
    chofer AS chofer,                       -- Chofer
    orden AS orden,                         -- Orden
    pago AS pago,                           -- Pago
    tpago AS tpago,                         -- Tipo de pago
    cobrar_CDAg AS cobrar,                  -- Cobrar
    estadoPed AS estadoPedido,              -- Estado del pedido
    'A' AS status,                          -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at,        -- Fecha actual como created_at
    CURRENT_TIMESTAMP AS updated_at         -- Fecha actual como updated_at
FROM fraschin_backup.CDagenda
WHERE id_CDAg IS NOT NULL;                  -- Asegurar que el ID no sea nulo
