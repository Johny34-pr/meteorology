DELETE m
FROM measurements m
INNER JOIN operators o ON o.operator_id = m.operator_id
INNER JOIN instruments i ON i.instrument_id = m.instrument_id
WHERE {whereSql};