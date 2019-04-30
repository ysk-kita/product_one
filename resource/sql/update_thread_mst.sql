UPDATE
  thread_mst 
SET
  rows = rows + 1
WHERE
  thread_id = ?
;