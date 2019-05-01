SELECT
  login_id,
  handle_name,
  password
FROM
  user_mst
WHERE
  login_id = ?
;