SELECT
    operator_id,
    email,
    username,
    name,
    station_name,
    reg_time
FROM
    `operators` o
    INNER JOIN `locations` l ON l.location_id = o.location_id
ORDER BY
    {field} {order}