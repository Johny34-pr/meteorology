SELECT
    instrument_id,
    name,
    type,
    model_number,
    status,
    station_name
FROM
    `instruments` i
    LEFT JOIN `locations` l ON l.location_id = i.location_id
ORDER BY
    name ASC;