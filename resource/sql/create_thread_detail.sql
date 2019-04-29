CREATE TABLE thread_detail (
    thread_id INTEGER PRIMARY KEY,
    row_no INTEGER UNIQUE AUTO_INCREMENT,
    text VARCHAR(1000),
    insert_user VARCHAR(100)
);