INSERT INTO fraschina_2024.agendas (
    id,
    nombre,
    apellido,
    nomApe,
    empresa_institucion,
    profesion_especialidad_oficio,
    cod_prof,
    tel_particular,
    tel_laboral,
    interno,
    celular,
    mail,
    direccion,
    observaciones,
    buscador1,
    buscador2,
    buscador3,
    status,
    created_at,
    updated_at
)
SELECT
    IDagenda AS id,
    Nombre AS nombre,
    Apellido AS apellido,
    nomApe AS nomApe,
    Empresa_Institucion AS empresa_institucion,
    Profesion_Especialidad_Oficio AS profesion_especialidad_oficio,
    cod_prof AS cod_prof,
    Tel_Particular AS tel_particular,
    Tel_Laboral AS tel_laboral,
    Interno AS interno,
    Celular AS celular,
    Mail AS mail,
    Direccion AS direccion,
    Observaciones AS observaciones,
    buscador1 AS buscador1,
    buscador2 AS buscador2,
    buscador3 AS buscador3,
    1 AS status,  -- Asignar un valor constante para 'status', por ejemplo, 1 (activo)
    CURRENT_TIMESTAMP AS created_at,  -- Fecha y hora actual para created_at
    CURRENT_TIMESTAMP AS updated_at  -- Fecha y hora actual para updated_at
FROM fraschin_backup.agendageneral
WHERE
    IDagenda IS NOT NULL;  -- Asegurarse de que 'IDagenda' no sea nulo
