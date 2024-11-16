SELECT
    location_id,
    station_name as name,
    city,
    county
FROM
    `locations` l
ORDER BY
    station_name ASC;