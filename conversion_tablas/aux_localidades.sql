INSERT INTO fraschina_2024.auxlocalidades (id, localidad, representaciones, distribuciones, molinos, proveedores, agros, transportes, agendas, created_at, updated_at)
SELECT 
    Idlocalidad AS id,
    Localidad AS localidad,
    clirep AS representaciones,
    clidis AS distribuciones,
    molinos AS molinos,
    proveedores AS proveedores,
    agro AS agros,
    transporte AS transportes,
    Agenda AS agendas,
    NOW() AS created_at,  -- Fecha y hora actual para created_at
    NOW() AS updated_at   -- Fecha y hora actual para updated_at
FROM fraschin_backup.auxlocalidades;
