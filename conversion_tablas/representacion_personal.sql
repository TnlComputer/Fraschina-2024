UPDATE fraschin_backup.personalclientes
SET `Idprofesion` = 132
WHERE `Idprofesion` = 40;

INSERT INTO fraschina_2024.representacion_personal (
  `nombre`, `apellido`, `representacion_id`, `area_id`, `cargo_id`, `categoriacargo_id`, 
  `teldirecto`, `interno`, `telcelular`, `profesion_id`, `telparticular`, `email`, 
  `observaciones`, `fuera`, `status`, `created_at`, `updated_at`
)
SELECT 
  `Nombre`, 
  `Apellido`, 
  IF(`Idcliente` = 0, NULL, `Idcliente`) AS `representacion_id`,  -- Asigna NULL si es 0
  `Idarea` AS `area_id`, 
  `Idcargo` AS `cargo_id`, 
  `cate_cargo` AS `categoriacargo_id`, 
  `TelDirecto` AS `teldirecto`, 
  `Interno` AS `interno`, 
  `TelCelular` AS `telcelular`, 
  `Idprofesion` AS `profesion_id`, 
  `Telparticular` AS `telparticular`, 
  `Mail` AS `email`, 
  `INFOparticular` AS `observaciones`, 
  `fuera`, 
  'A' AS `status`, 
  CURRENT_TIMESTAMP AS `created_at`, 
  CURRENT_TIMESTAMP AS `updated_at`
FROM fraschin_backup.personalclientes
WHERE Ipersona IS NOT NULL;


