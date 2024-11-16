SELECT 
    YEAR(timestamp) AS year,
    CASE 
        WHEN MONTH(timestamp) IN (12, 1, 2) THEN 'Tél'
        WHEN MONTH(timestamp) IN (3, 4, 5) THEN 'Tavasz'
        WHEN MONTH(timestamp) IN (6, 7, 8) THEN 'Nyár'
        WHEN MONTH(timestamp) IN (9, 10, 11) THEN 'Ősz'
    END AS season,
    AVG(value) AS average_value,
    unit
FROM measurements
GROUP BY YEAR(timestamp), season, unit
ORDER BY YEAR(timestamp), FIELD(season, 'Tél', 'Tavasz', 'Nyár', 'Ősz');