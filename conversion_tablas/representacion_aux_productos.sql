INSERT INTO representacion_aux_productos (
    id,           -- ID del producto
    nombre,       -- Nombre del producto
    is_active,    -- Estado activo (por defecto TRUE)
    created_at,   -- Fecha y hora de creación
    updated_at    -- Fecha y hora de última actualización
)
SELECT
    Id_Producto AS id,          -- ID del producto en la tabla original
    Producto AS nombre,         -- Nombre del producto en la tabla original
    TRUE AS is_active,          -- Asignar TRUE como valor constante para 'is_active'
    CURRENT_TIMESTAMP AS created_at,  -- Fecha y hora actual para 'created_at'
    CURRENT_TIMESTAMP AS updated_at   -- Fecha y hora actual para 'updated_at'
FROM fraschin_backup.auxproductos
WHERE 
    Id_Producto IS NOT NULL;    -- Asegurarse de que 'Id_Producto' no sea nulo
