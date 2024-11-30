SELECT
    operator_id,
    email,
    username,
    name,
    IF((station_name IS NULL), "", station_name) AS station,
    reg_time
FROM
    `operators` o
    LEFT JOIN `locations` l ON l.location_id = o.location_id
ORDER BY
    {field} {order}