INSERT INTO fraschina_2024.proveedor_productos (
    id,            -- ID principal
    proveedor_id,  -- Relación con proveedores
    producto_id,   -- Relación con productos
    status,        -- Estado del registro
    created_at,    -- Fecha de creación
    updated_at     -- Fecha de actualización
)
SELECT
    idProProveedor AS id,       -- Mapeo de ID
    Idproveedores AS proveedor_id,  -- Relación con proveedores
    Idproducto AS producto_id,      -- Relación con productos
    'A' AS status,               -- Estado activo por defecto
    CURRENT_TIMESTAMP AS created_at,  -- Fecha actual como created_at
    CURRENT_TIMESTAMP AS updated_at   -- Fecha actual como updated_at
FROM fraschin_backup.productoporproveedor
WHERE idProProveedor IS NOT NULL;  -- Asegurar que el ID no sea nulo
