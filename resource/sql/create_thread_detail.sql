CREATE TABLE thread_detail (
    thread_id INTEGER,
    row_no INTEGER,
    text VARCHAR(1000),
    insert_user VARCHAR(100),
    PRIMARY KEY(thread_id, row_no)
);