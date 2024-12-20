INSERT INTO fraschina_2024.auxzonas (id, nombre, representaciones, distribuciones, molinos, proveedores, agros, transportes, agendas, created_at, updated_at)
SELECT 
    IdZona AS id,
    NomZona AS nombre,
    agro AS representaciones,
    clirep AS distribuciones,
    clidis AS molinos,
    molinos AS proveedores,
    proveedores AS agros,
    transporte AS transportes,
    Agenda AS agendas,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxzonas;
