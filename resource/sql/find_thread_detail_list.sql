SELECT
  row_no,
  text,
  insert_user
FROM 
  thread_detail
WHERE
  thread_id = ?
;