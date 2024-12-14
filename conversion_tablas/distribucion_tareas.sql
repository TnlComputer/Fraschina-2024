INSERT INTO fraschina_2024.distribucion_tareas (
    id,
    tarea,
    status,
    created_at,
    updated_at
)
SELECT
    idTcdA AS id,               -- Mapeo de idTcdA al campo id
    tareasCDA AS tarea,         -- Mapeo de tareasCDA al campo tarea
    'A' AS status,              -- Asignar 'A' como estado por defecto
    CURRENT_TIMESTAMP AS created_at,  -- Fecha actual para created_at
    CURRENT_TIMESTAMP AS updated_at   -- Fecha actual para updated_at
FROM fraschin_backup.tareascda
WHERE
    idTcdA IS NOT NULL; -- Asegurarse de que la clave primaria no sea nula
